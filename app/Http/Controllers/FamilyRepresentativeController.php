<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FamilyRepresentative;
use App\Models\Proposal;
use App\Models\PhotoAccessGrant;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FamilyRepresentativeController extends Controller
{
    /**
     * Dedicated Family Dashboard (FR-5.4)
     */
    public function dashboard()
    {
        $repUser = Auth::user();

        // Get wards represented by this family elder
        $links = FamilyRepresentative::with(['seekerUser.profile', 'seekerUser.kundli'])
            ->where('rep_user_id', $repUser->id)
            ->get();

        $wardIds = $links->pluck('seeker_user_id');

        // Inbound proposals awaiting representative review
        $pendingProposals = Proposal::with(['sender.profile', 'sender.kundli', 'receiver'])
            ->whereIn('receiver_user_id', $wardIds)
            ->whereIn('status', ['routed_to_family', 'pending'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Active accepted proposals with oversight
        $acceptedProposals = Proposal::with(['sender', 'receiver'])
            ->where(function ($q) use ($wardIds) {
                $q->whereIn('sender_user_id', $wardIds)->orWhereIn('receiver_user_id', $wardIds);
            })
            ->where('status', 'accepted')
            ->get();

        return view('family.dashboard', compact('links', 'pendingProposals', 'acceptedProposals'));
    }

    /**
     * Seeker setting up their Family Representatives
     */
    public function index()
    {
        $user = Auth::user();
        $representatives = FamilyRepresentative::with('representativeUser')
            ->where('seeker_user_id', $user->id)
            ->get();

        return view('family.manage', compact('representatives'));
    }

    public function store(Request $request)
    {
        $seeker = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'relationship' => 'required|in:Father,Mother,Brother,Sister,Uncle,Aunt,Grandparent,Elder',
            'permission_scope' => 'required|in:approval_required,read_only_oversight,full_proxy',
        ]);

        // Find or create representative user (Perpetually free tier FR-5.6)
        $repUser = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'role' => 'family_rep',
                'profile_managed_by' => 'self',
                'membership_tier' => 'free',
                'password' => Hash::make(Str::random(12)),
                'status' => 'active',
            ]
        );

        FamilyRepresentative::updateOrCreate(
            ['seeker_user_id' => $seeker->id, 'rep_user_id' => $repUser->id],
            [
                'relationship' => $validated['relationship'],
                'permission_scope' => $validated['permission_scope'],
                'is_verified' => true,
            ]
        );

        AuditLog::log('family_rep_linked', [
            'seeker_id' => $seeker->id,
            'rep_id' => $repUser->id,
            'relationship' => $validated['relationship'],
            'scope' => $validated['permission_scope'],
        ], $seeker->id);

        return back()->with('success', "{$validated['relationship']} linked successfully as Family Representative.");
    }

    public function remove($id)
    {
        $seeker = Auth::user();
        $link = FamilyRepresentative::where('id', $id)->where('seeker_user_id', $seeker->id)->firstOrFail();
        $link->delete();

        return back()->with('success', 'Family representative unlinked.');
    }

    /**
     * Family Representative proposal decision with dignified response macros (FR-5.4)
     */
    public function handleProposal(Request $request, $proposalId)
    {
        $repUser = Auth::user();
        $action = $request->input('action'); // 'approve' or 'decline'
        $customNote = $request->input('family_rep_notes');

        $proposal = Proposal::with(['sender', 'receiver'])->findOrFail($proposalId);

        // Verify that this user is indeed an authorized representative for the receiver
        $link = FamilyRepresentative::where('seeker_user_id', $proposal->receiver_user_id)
            ->where('rep_user_id', $repUser->id)
            ->firstOrFail();

        if ($action === 'approve') {
            $proposal->update([
                'status' => 'accepted',
                'family_rep_notes' => $customNote ?? 'Blessings from family elders. We are pleased to encourage this dialogue.',
                'responded_at' => now(),
            ]);

            // Unlock photo permissions
            PhotoAccessGrant::updateOrCreate(
                ['owner_user_id' => $proposal->receiver_user_id, 'grantee_user_id' => $proposal->sender_user_id],
                ['status' => 'granted', 'granted_at' => now()]
            );
            PhotoAccessGrant::updateOrCreate(
                ['owner_user_id' => $proposal->sender_user_id, 'grantee_user_id' => $proposal->receiver_user_id],
                ['status' => 'granted', 'granted_at' => now()]
            );

            AuditLog::log('proposal_approved_by_family', ['proposal_id' => $proposal->id], $repUser->id);
            return back()->with('success', 'Proposal approved with familial blessings. Communication and photo permissions are now unlocked.');
        } else {
            $proposal->update([
                'status' => 'declined',
                'family_rep_notes' => $customNote ?? 'With utmost respect and good wishes for your family, our elders feel our horizons are not suitably aligned at this time.',
                'responded_at' => now(),
            ]);

            AuditLog::log('proposal_declined_by_family', ['proposal_id' => $proposal->id], $repUser->id);
            return back()->with('info', 'Proposal declined with polite formal family note.');
        }
    }
}

