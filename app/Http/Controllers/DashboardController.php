<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Message;
use App\Models\Shortlist;
use App\Models\FamilyRepresentative;
use App\Models\VivahMilestone;
use App\Models\IdentityVerification;
use App\Models\UserReport;
use App\Services\AstrologyService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected AstrologyService $astrologyService;

    public function __construct(AstrologyService $astrologyService)
    {
        $this->astrologyService = $astrologyService;
    }

    /**
     * Dispatch authenticated user to their role-specific dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'family_rep') {
            return redirect()->route('family.dashboard');
        }

        if ($user->role === 'pandit') {
            return $this->panditDashboard($request);
        }

        if ($user->gender === 'female' || $user->role === 'bride') {
            return $this->brideDashboard($request);
        }

        return $this->groomDashboard($request);
    }

    /**
     * Dedicated Groom Dashboard (Var Portal)
     */
    public function groomDashboard(Request $request)
    {
        $user = Auth::user();

        // Target opposite gender: Brides
        $bridesQuery = User::with(['profile', 'kundli', 'photos'])
            ->where('gender', 'female')
            ->where('status', 'active');

        $totalCompatibleBrides = (clone $bridesQuery)->count();
        $recentBrides = (clone $bridesQuery)->latest()->take(3)->get();

        // Calculate astrological compatibility for top brides
        $recommendedBrides = $recentBrides->map(function ($bride) use ($user) {
            $comp = $this->astrologyService->calculateOverallCompatibility($user, $bride);
            return [
                'user' => $bride,
                'compatibility' => $comp,
            ];
        });

        // Proposals stats
        $pendingReceivedProposals = Proposal::with(['sender.profile', 'sender.kundli', 'sender.photos'])
            ->where('receiver_user_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->get();

        $sentProposalsCount = Proposal::where('sender_user_id', $user->id)->count();
        $shortlistsCount = Shortlist::where('user_id', $user->id)->count();
        $unreadMessagesCount = Message::where('receiver_user_id', $user->id)->whereNull('read_at')->count();

        // Linked Family Elder / Ghotok
        $familyRepLink = FamilyRepresentative::with('representativeUser')
            ->where('seeker_user_id', $user->id)
            ->first();

        // Milestone
        $milestone = VivahMilestone::where('spouse_a_user_id', $user->id)
            ->orWhere('spouse_b_user_id', $user->id)
            ->latest()
            ->first();

        return view('dashboard.groom', [
            'user' => $user,
            'profile' => $user->profile,
            'kundli' => $user->kundli,
            'totalCompatibleBrides' => $totalCompatibleBrides,
            'recommendedBrides' => $recommendedBrides,
            'pendingReceivedProposals' => $pendingReceivedProposals,
            'sentProposalsCount' => $sentProposalsCount,
            'shortlistsCount' => $shortlistsCount,
            'unreadMessagesCount' => $unreadMessagesCount,
            'familyRepLink' => $familyRepLink,
            'milestone' => $milestone,
            'isPro' => $user->isPro(),
        ]);
    }

    /**
     * Dedicated Bride Dashboard (Kanya Portal)
     */
    public function brideDashboard(Request $request)
    {
        $user = Auth::user();

        // Target opposite gender: Grooms
        $groomsQuery = User::with(['profile', 'kundli', 'photos'])
            ->where('gender', 'male')
            ->where('status', 'active');

        $totalCompatibleGrooms = (clone $groomsQuery)->count();
        $recentGrooms = (clone $groomsQuery)->latest()->take(3)->get();

        // Calculate astrological compatibility for suitors
        $recommendedGrooms = $recentGrooms->map(function ($groom) use ($user) {
            $comp = $this->astrologyService->calculateOverallCompatibility($user, $groom);
            return [
                'user' => $groom,
                'compatibility' => $comp,
            ];
        });

        // Suitor Proposals awaiting bride's decision
        $pendingReceivedProposals = Proposal::with(['sender.profile', 'sender.kundli'])
            ->where('receiver_user_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->get();

        $sentProposalsCount = Proposal::where('sender_user_id', $user->id)->count();
        $shortlistsCount = Shortlist::where('user_id', $user->id)->count();
        $unreadMessagesCount = Message::where('receiver_user_id', $user->id)->whereNull('read_at')->count();

        // Linked Family Elder / Ghotok
        $familyRepLink = FamilyRepresentative::with('representativeUser')
            ->where('seeker_user_id', $user->id)
            ->first();

        // Milestone
        $milestone = VivahMilestone::where('spouse_a_user_id', $user->id)
            ->orWhere('spouse_b_user_id', $user->id)
            ->latest()
            ->first();

        // Photo privacy setting
        $photoPrivacy = $user->profile?->photo_privacy ?? 'blur_until_mutual';

        return view('dashboard.bride', [
            'user' => $user,
            'profile' => $user->profile,
            'kundli' => $user->kundli,
            'totalCompatibleGrooms' => $totalCompatibleGrooms,
            'recommendedGrooms' => $recommendedGrooms,
            'pendingReceivedProposals' => $pendingReceivedProposals,
            'sentProposalsCount' => $sentProposalsCount,
            'shortlistsCount' => $shortlistsCount,
            'unreadMessagesCount' => $unreadMessagesCount,
            'familyRepLink' => $familyRepLink,
            'milestone' => $milestone,
            'photoPrivacy' => $photoPrivacy,
            'isPro' => $user->isPro(),
        ]);
    }

    /**
     * Dedicated Pandit & Acharya Matchmaking Dashboard
     */
    public function panditDashboard(Request $request)
    {
        $user = Auth::user();

        // All active seekers
        $grooms = User::where('gender', 'male')->where('status', 'active')->with(['profile', 'kundli'])->get();
        $brides = User::where('gender', 'female')->where('status', 'active')->with(['profile', 'kundli'])->get();

        // Sagotra Lineage review cases (seekers with same gotra)
        $sagotraCases = [];
        foreach ($grooms as $groom) {
            foreach ($brides as $bride) {
                if (!empty($groom->profile?->gotra) && !empty($bride->profile?->gotra) && strcasecmp($groom->profile->gotra, $bride->profile->gotra) === 0) {
                    $sagotraCases[] = [
                        'groom' => $groom,
                        'bride' => $bride,
                        'gotra' => $groom->profile->gotra,
                    ];
                }
            }
        }

        // Solemnized Milestones
        $solemnizedMilestones = VivahMilestone::with(['spouseA.profile', 'spouseB.profile'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.pandit', [
            'user' => $user,
            'groomsCount' => $grooms->count(),
            'bridesCount' => $brides->count(),
            'totalKundlis' => User::whereHas('kundli')->count(),
            'sagotraCases' => array_slice($sagotraCases, 0, 5),
            'solemnizedMilestones' => $solemnizedMilestones,
            'grooms' => $grooms,
            'brides' => $brides,
        ]);
    }
}

