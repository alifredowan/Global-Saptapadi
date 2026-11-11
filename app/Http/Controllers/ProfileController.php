<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;
use App\Models\Profile;
use App\Models\Photo;
use App\Models\AuditLog;
use App\Services\PhotoPrivacyService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id = null)
    {
        $viewer = Auth::user();
        $targetUser = $id ? User::with(['profile', 'kundli', 'photos'])->findOrFail($id) : $viewer;

        // Daily view limits for Free Explorer tier (FR-7.4)
        if ($viewer->id !== $targetUser->id && !$viewer->isPro()) {
            if (!$viewer->canViewProfileToday()) {
                return redirect()->route('membership.index')->with('error', 'Free Explorer daily view limit reached (10 profiles/day). Upgrade to Pro Single Vivah Pass for unlimited discovery.');
            }
            $viewer->incrementDailyProfileView();
        }

        $canViewPhotos = $viewer->canViewUnblurredPhotoOf($targetUser);

        return view('profile.show', [
            'user' => $targetUser,
            'profile' => $targetUser->profile,
            'kundli' => $targetUser->kundli,
            'canViewPhotos' => $canViewPhotos,
            'isOwnProfile' => ($viewer->id === $targetUser->id),
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);
        $kundli = $user->kundli;
        $photos = $user->photos;

        return view('profile.edit', compact('user', 'profile', 'kundli', 'photos'));
    }

    public function update(UpdateProfileRequest $request, PhotoPrivacyService $photoService)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $validated = $request->validated();

        if (isset($validated['marital_status'])) {
            $user->update(['marital_status' => $validated['marital_status']]);
            unset($validated['marital_status']);
        }

        // Checkbox values default handling
        $validated['caste_no_bar'] = $request->boolean('caste_no_bar');
        $validated['mask_income'] = $request->boolean('mask_income');
        $validated['mask_gotra'] = $request->boolean('mask_gotra');
        $validated['mask_caste'] = $request->boolean('mask_caste');
        $validated['mask_kundli'] = $request->boolean('mask_kundli');

        $profile->fill($validated);
        $profile->save();

        // Calculate completeness
        $profile->calculateCompleteness();

        // Handle Photo Uploads
        if ($request->hasFile('photos')) {
            $currentPhotoCount = $user->photos()->count();
            foreach ($request->file('photos') as $photoFile) {
                if ($currentPhotoCount < 6) {
                    $photoService->savePhoto($user, $photoFile);
                    $currentPhotoCount++;
                }
            }
        }

        AuditLog::log('profile_updated', ['completeness' => $profile->profile_completeness_pct], $user->id);

        return redirect()->route('profile.edit')->with('success', 'Biodata updated successfully!');
    }

    public function deletePhoto($photoId)
    {
        $photo = Photo::where('id', $photoId)->where('user_id', Auth::id())->firstOrFail();
        if (file_exists(public_path($photo->photo_path))) {
            @unlink(public_path($photo->photo_path));
        }
        if ($photo->blurred_photo_path && file_exists(public_path($photo->blurred_photo_path))) {
            @unlink(public_path($photo->blurred_photo_path));
        }
        $photo->delete();
        return back()->with('success', 'Photo removed.');
    }

    public function setPrimaryPhoto($photoId)
    {
        Photo::where('user_id', Auth::id())->update(['is_primary' => false]);
        Photo::where('id', $photoId)->where('user_id', Auth::id())->update(['is_primary' => true]);
        return back()->with('success', 'Primary photo updated.');
    }

    public function deactivateAccount(Request $request)
    {
        $user = Auth::user();
        $user->update(['status' => 'deactivated']);
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login')->with('success', 'Your profile has been temporarily deactivated and hidden from discovery.');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        AuditLog::log('account_erasure_requested', ['email' => $user->email], $user->id);
        $user->delete(); // Cascades all linked data complying with DPDP / GDPR erasure
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login')->with('success', 'Your account and personal data have been permanently erased.');
    }

    public function privacySettings()
    {
        $user = Auth::user();
        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);
        $compliance = \App\Services\ComplianceService::getSettings();
        return view('settings.privacy', compact('user', 'profile', 'compliance'));
    }

    public function updatePrivacySettings(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $validated = $request->validate([
            'photo_privacy' => 'required|in:blur_until_mutual,public,restricted',
            'phone_visibility' => 'nullable|in:mutual_family_only,chaperone_approved',
        ]);

        $profile->update([
            'photo_privacy' => $validated['photo_privacy'],
        ]);

        return back()->with('success', 'Privacy preferences updated.');
    }
}

