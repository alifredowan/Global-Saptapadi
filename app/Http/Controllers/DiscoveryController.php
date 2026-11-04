<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shortlist;
use App\Models\UserBlock;
use App\Services\AstrologyService;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DiscoveryController extends Controller
{
    protected AstrologyService $astrologyService;

    public function __construct(AstrologyService $astrologyService)
    {
        $this->astrologyService = $astrologyService;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        // Target opposite gender (Strict heterosexual indexing: Groom seeks Bride, Bride seeks Groom)
        $targetGender = ($user->gender === 'male') ? 'female' : 'male';

        $query = User::with(['profile', 'kundli', 'photos'])
            ->where('gender', $targetGender)
            ->where('status', 'active'); // Married and deactivated excluded automatically

        // Exclude blocked users (Silent mutual blocking)
        $blockedUserIds = UserBlock::where('blocker_id', $user->id)
            ->orWhere('blocked_id', $user->id)
            ->pluck('blocked_id')
            ->merge(UserBlock::where('blocked_id', $user->id)->pluck('blocker_id'))
            ->unique();
        if ($blockedUserIds->isNotEmpty()) {
            $query->whereNotIn('id', $blockedUserIds);
        }

        // Basic Filter: Age range
        if ($request->filled('min_age')) {
            $maxBirthDate = Carbon::now()->subYears((int)$request->input('min_age'))->endOfDay();
            $query->where('date_of_birth', '<=', $maxBirthDate);
        }
        if ($request->filled('max_age')) {
            $minBirthDate = Carbon::now()->subYears((int)$request->input('max_age') + 1)->startOfDay();
            $query->where('date_of_birth', '>=', $minBirthDate);
        }

        // Basic Filter: Marital status
        if ($request->filled('marital_status')) {
            $query->where('marital_status', $request->input('marital_status'));
        }

        // Profile relations filters
        $query->whereHas('profile', function ($q) use ($request, $user) {
            // City / Location
            if ($request->filled('city')) {
                $q->where('city', 'ILIKE', '%' . $request->input('city') . '%');
            }

            // Mother tongue
            if ($request->filled('mother_tongue')) {
                $q->where('mother_tongue', $request->input('mother_tongue'));
            }

            // Diet
            if ($request->filled('diet')) {
                $q->where('diet', $request->input('diet'));
            }

            // Sampradaya (Pro Filter)
            if ($request->filled('sampradaya')) {
                $q->where('sampradaya', $request->input('sampradaya'));
            }

            // Caste / Jati (Pro Filter)
            if ($request->filled('caste_jati')) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('caste_jati', 'ILIKE', '%' . $request->input('caste_jati') . '%')
                        ->orWhere('caste_no_bar', true);
                });
            }

            // Education level (Pro Filter)
            if ($request->filled('qualification_level')) {
                $q->where('qualification_level', 'ILIKE', '%' . $request->input('qualification_level') . '%');
            }

            // Gotra exclusion (Pro Filter): Exclude same gotra if requested
            if ($request->boolean('exclude_same_gotra') && $user->profile?->gotra) {
                $q->where('gotra', '!=', $user->profile->gotra);
            }
        });

        // Kundli Filters (Pro Filter)
        if ($request->filled('manglik_status')) {
            $query->whereHas('kundli', function ($q) use ($request) {
                $q->where('manglik_status', $request->input('manglik_status'));
            });
        }

        $candidates = $query->paginate(12)->withQueryString();

        // Calculate compatibility score and gotra advisories for each candidate
        $results = $candidates->getCollection()->map(function ($candidate) use ($user) {
            $compatibility = $this->astrologyService->calculateOverallCompatibility($user, $candidate);
            $canViewPhotos = $user->canViewUnblurredPhotoOf($candidate);
            $isShortlisted = Shortlist::where('user_id', $user->id)->where('candidate_user_id', $candidate->id)->exists();

            return [
                'user' => $candidate,
                'compatibility' => $compatibility,
                'can_view_photos' => $canViewPhotos,
                'is_shortlisted' => $isShortlisted,
            ];
        });

        return view('discovery.index', [
            'candidates' => $candidates,
            'results' => $results,
            'filters' => $request->all(),
            'isPro' => $user->isPro(),
        ]);
    }

    public function toggleShortlist(Request $request, $candidateId)
    {
        $user = Auth::user();
        $candidate = User::findOrFail($candidateId);

        $shortlist = Shortlist::where('user_id', $user->id)->where('candidate_user_id', $candidate->id)->first();

        if ($shortlist) {
            $shortlist->delete();
            $message = 'Removed from your private shortlist.';
        } else {
            Shortlist::create([
                'user_id' => $user->id,
                'candidate_user_id' => $candidate->id,
                'confidential_notes' => $request->input('notes'),
            ]);
            $message = 'Candidate added to private shortlist.';
        }

        return back()->with('success', $message);
    }

    public function shortlists()
    {
        $user = Auth::user();
        $shortlists = Shortlist::with(['candidate.profile', 'candidate.kundli'])->where('user_id', $user->id)->get();

        return view('discovery.shortlists', compact('shortlists'));
    }
}

