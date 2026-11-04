<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VivahMilestone;
use App\Models\Proposal;
use App\Services\CertificateService;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MilestoneController extends Controller
{
    protected CertificateService $certificateService;

    public function __construct(CertificateService $certificateService)
    {
        $this->certificateService = $certificateService;
    }

    public function index()
    {
        $user = Auth::user();

        // Check if user has an existing milestone
        $milestone = VivahMilestone::with(['spouseA.profile', 'spouseB.profile'])
            ->where(function ($q) use ($user) {
                $q->where('spouse_a_user_id', $user->id)->orWhere('spouse_b_user_id', $user->id);
            })->first();

        // Candidates eligible for marriage declaration (those with accepted proposals)
        $eligibleSpouseIds = Proposal::where(function ($q) use ($user) {
            $q->where('sender_user_id', $user->id)->orWhere('receiver_user_id', $user->id);
        })->where('status', 'accepted')->get()->map(function ($prop) use ($user) {
            return ($prop->sender_user_id === $user->id) ? $prop->receiver_user_id : $prop->sender_user_id;
        })->unique();

        $eligibleSpouses = User::whereIn('id', $eligibleSpouseIds)->get();

        return view('milestone.index', compact('user', 'milestone', 'eligibleSpouses'));
    }

    public function declareMarriage(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'spouse_id' => 'required|exists:users,id',
            'wedding_date' => 'required|date',
            'success_story' => 'nullable|string|max:2000',
            'wedding_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $spouse = User::findOrFail($validated['spouse_id']);

        $weddingPhotoPath = null;
        if ($request->hasFile('wedding_photo')) {
            $file = $request->file('wedding_photo');
            $filename = 'wedding_' . Str::random(12) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/milestones'), $filename);
            $weddingPhotoPath = 'uploads/milestones/' . $filename;
        }

        $milestone = VivahMilestone::create([
            'spouse_a_user_id' => $user->id,
            'spouse_b_user_id' => $spouse->id,
            'wedding_date' => $validated['wedding_date'],
            'certificate_uuid' => (string) Str::uuid(),
            'status' => 'confirmed', // Confirmed union
            'success_story' => $validated['success_story'],
            'wedding_photo_path' => $weddingPhotoPath,
            'published_to_stories' => $request->boolean('publish_story'),
            'confirmed_at' => now(),
        ]);

        // Trigger certificate generation & automated de-indexing
        $this->certificateService->finalizeMarriageMilestone($milestone);

        return redirect()->route('milestone.certificate', $milestone->certificate_uuid)
            ->with('success', 'Shubho Bibaho! Your marriage union has been officially commemorated, and your digital certificate is ready.');
    }

    public function viewCertificate($uuid)
    {
        $milestone = VivahMilestone::with(['spouseA.profile', 'spouseB.profile'])
            ->where('certificate_uuid', $uuid)
            ->firstOrFail();

        $groom = $milestone->spouseA->gender === 'male' ? $milestone->spouseA : $milestone->spouseB;
        $bride = $milestone->spouseA->gender === 'female' ? $milestone->spouseA : $milestone->spouseB;

        return view('certificates.shubho_bibaho', [
            'milestone' => $milestone,
            'groom' => $groom,
            'bride' => $bride,
            'groomGotra' => $groom->profile?->gotra ?? 'Vedic Lineage',
            'brideGotra' => $bride->profile?->gotra ?? 'Vedic Lineage',
            'weddingDate' => $milestone->wedding_date->format('d/m/Y'),
            'uuid' => $milestone->certificate_uuid,
        ]);
    }
}

