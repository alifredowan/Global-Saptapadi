<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proposal;
use App\Models\FamilyRepresentative;
use App\Models\PhotoAccessGrant;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Inbound proposals
        $inboundProposals = Proposal::with(['sender.profile', 'sender.kundli'])
            ->where('receiver_user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Outbound proposals
        $outboundProposals = Proposal::with(['receiver.profile', 'receiver.kundli'])
            ->where('sender_user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('proposals.index', compact('inboundProposals', 'outboundProposals'));
    }

    public function store(Request $request, $receiverId)
    {
        $sender = Auth::user();
        $receiver = User::with('familyRepresentatives')->findOrFail($receiverId);

        // Cannot send proposal to self
        if ($sender->id === $receiver->id) {
            return back()->with('error', 'You cannot send a matrimonial interest to yourself.');
        }

        // Daily activity throttling (FR-7.4: Free tier capped at 5/day, Pro unlimited)
        if (!$sender->canSendProposalToday()) {
            return redirect()->route('membership.index')->with('error', 'Free Explorer daily interest limit reached (5 proposals/day). Upgrade to Pro Single Vivah Pass for unlimited proposals.');
        }

        // Check existing proposal
        $existing = Proposal::where(function ($q) use ($sender, $receiver) {
            $q->where('sender_user_id', $sender->id)->where('receiver_user_id', $receiver->id);
        })->orWhere(function ($q) use ($sender, $receiver) {
            $q->where('sender_user_id', $receiver->id)->where('receiver_user_id', $sender->id);
        })->first();

        if ($existing) {
            return back()->with('info', "A proposal between these profiles is already active (Status: {$existing->status}).");
        }

        $note = $request->input('introductory_note') ?? 'Namaskar. With deep respect for your family, I have reviewed your biodata and feel our values and Dharmic aspirations align. We would be honored to begin a conversation.';

        // Check if receiver has Family Representative with "approval_required" (FR-7.2)
        $hasApprovalRep = $receiver->familyRepresentatives()->where('permission_scope', 'approval_required')->exists();
        $initialStatus = $hasApprovalRep ? 'routed_to_family' : 'pending';

        $proposal = Proposal::create([
            'sender_user_id' => $sender->id,
            'receiver_user_id' => $receiver->id,
            'introductory_note' => $note,
            'status' => $initialStatus,
        ]);

        $sender->incrementDailyProposal();

        AuditLog::log('proposal_sent', [
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'routed_to_family' => $hasApprovalRep,
        ], $sender->id);

        $msg = $hasApprovalRep 
            ? 'Formal matrimonial interest submitted and gracefully routed to the Family Representative for initial blessing.' 
            : 'Formal matrimonial interest transmitted successfully.';

        return back()->with('success', $msg);
    }

    public function accept($id)
    {
        $user = Auth::user();
        $proposal = Proposal::where('id', $id)->where('receiver_user_id', $user->id)->firstOrFail();

        $proposal->update([
            'status' => 'accepted',
            'responded_at' => now(),
        ]);

        // Acceptance unlocks mutual photo access (FR-7.3)
        PhotoAccessGrant::updateOrCreate(
            ['owner_user_id' => $user->id, 'grantee_user_id' => $proposal->sender_user_id],
            ['status' => 'granted', 'granted_at' => now()]
        );
        PhotoAccessGrant::updateOrCreate(
            ['owner_user_id' => $proposal->sender_user_id, 'grantee_user_id' => $user->id],
            ['status' => 'granted', 'granted_at' => now()]
        );

        AuditLog::log('proposal_accepted', ['proposal_id' => $proposal->id], $user->id);

        return back()->with('success', 'Proposal accepted with dignity. Encrypted chaperoned communication and full photo reveal are now unlocked!');
    }

    public function decline(Request $request, $id)
    {
        $user = Auth::user();
        $proposal = Proposal::where('id', $id)->where('receiver_user_id', $user->id)->firstOrFail();

        $proposal->update([
            'status' => 'declined',
            'responded_at' => now(),
        ]);

        AuditLog::log('proposal_declined', ['proposal_id' => $proposal->id], $user->id);

        return back()->with('info', 'Matrimonial proposal respectfully declined.');
    }
}

