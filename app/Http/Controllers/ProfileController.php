<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function update(Request $request, PhotoPrivacyService $photoService)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $validated = $request->validate([
            // Physical & Personal
            'height_cm' => 'nullable|integer|min:120|max:230',
            'weight_kg' => 'nullable|integer|min:35|max:200',
            'complexion' => 'nullable|string',
            'mother_tongue' => 'nullable|string',
            'citizenship' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'marital_status' => 'nullable|in:never_married,divorced,widowed,annulled',
            'dependent_children' => 'nullable|integer|min:0',

            // Education & Profession
            'qualification_level' => 'nullable|string',
            'education_detail' => 'nullable|string',
            'profession' => 'nullable|string',
            'organization_type' => 'nullable|string',
            'annual_income_range' => 'nullable|string',

            // Religion & Lineage
            'religion' => 'nullable|string',
            'sampradaya' => 'nullable|string',
            'caste_jati' => 'nullable|string',
            'sub_caste' => 'nullable|string',
            'caste_no_bar' => 'nullable|boolean',
            'gotra' => 'nullable|string',
            'nanihal_gotra' => 'nullable|string',

            // Lifestyle & Habits
            'diet' => 'nullable|in:vegetarian,eggetarian,non_vegetarian,jain,vegan',
            'smoking' => 'nullable|in:never,occasionally,regularly',
            'alcohol' => 'nullable|in:never,occasionally,regularly',

            // Spiritual Practice
            'puja_frequency' => 'nullable|string',
            'temple_visits' => 'nullable|string',
            'fasting_vrata' => 'nullable|string',
            'scripture_study' => 'nullable|string',
            'guru_lineage' => 'nullable|string',
            'tilak_preference' => 'nullable|string',
            'post_marriage_customs' => 'nullable|string',

            // Family
            'family_structure' => 'nullable|in:nuclear,joint',
            'family_values' => 'nullable|in:traditional,moderate,liberal',
            'father_occupation' => 'nullable|string',
            'mother_occupation' => 'nullable|string',
            'brothers_count' => 'nullable|integer|min:0',
            'sisters_count' => 'nullable|integer|min:0',
            'native_ancestry' => 'nullable|string',
            'living_arrangements_preference' => 'nullable|string',

            // Narrative Bio
            'about_me' => 'nullable|string|max:2000',
            'partner_preferences_bio' => 'nullable|string|max:2000',

            // Photo & Field Privacy
            'photo_privacy' => 'nullable|in:public,blur_until_mutual,restricted',
            'mask_income' => 'nullable|boolean',
            'mask_gotra' => 'nullable|boolean',
            'mask_caste' => 'nullable|boolean',
            'mask_kundli' => 'nullable|boolean',

            // Photos upload (up to 6)
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

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
}

