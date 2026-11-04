<?php

namespace App\Services;

use App\Models\User;
use App\Models\Photo;
use App\Models\PhotoAccessGrant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class PhotoPrivacyService
{
    /**
     * Store photo and create blurred companion version for privacy protection.
     */
    public function savePhoto(User $user, UploadedFile $file, bool $isPrimary = false): Photo
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $uploadDir = public_path('uploads/photos');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $normalPath = 'uploads/photos/' . $filename;
        $file->move($uploadDir, $filename);

        // Generate blurred version using GD
        $blurredFilename = 'blur_' . $filename;
        $blurredPath = 'uploads/photos/' . $blurredFilename;
        $this->createBlurredImage(public_path($normalPath), public_path($blurredPath));

        if ($isPrimary) {
            Photo::where('user_id', $user->id)->update(['is_primary' => false]);
        }

        $photoCount = Photo::where('user_id', $user->id)->count();

        return Photo::create([
            'user_id' => $user->id,
            'photo_path' => $normalPath,
            'blurred_photo_path' => $blurredPath,
            'is_primary' => $isPrimary || ($photoCount === 0),
            'status' => 'approved',
            'sort_order' => $photoCount,
        ]);
    }

    /**
     * Create Gaussian-style blur using GD image processing.
     */
    protected function createBlurredImage(string $sourcePath, string $destPath): void
    {
        if (!extension_loaded('gd') || !file_exists($sourcePath)) {
            copy($sourcePath, $destPath);
            return;
        }

        $info = getimagesize($sourcePath);
        if (!$info) {
            copy($sourcePath, $destPath);
            return;
        }

        $image = null;
        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_WEBP:
                $image = imagecreatefromwebp($sourcePath);
                break;
            default:
                copy($sourcePath, $destPath);
                return;
        }

        if ($image) {
            // Apply heavy selective blur
            for ($i = 0; $i < 25; $i++) {
                imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
            }
            imagefilter($image, IMG_FILTER_SMOOTH, -5);
            imagejpeg($image, $destPath, 60);
            imagedestroy($image);
        } else {
            copy($sourcePath, $destPath);
        }
    }

    /**
     * Grant photo access to another user.
     */
    public function grantAccess(User $owner, User $grantee): PhotoAccessGrant
    {
        return PhotoAccessGrant::updateOrCreate(
            ['owner_user_id' => $owner->id, 'grantee_user_id' => $grantee->id],
            ['status' => 'granted', 'granted_at' => now()]
        );
    }

    /**
     * Revoke photo access from another user.
     */
    public function revokeAccess(User $owner, User $grantee): void
    {
        PhotoAccessGrant::where('owner_user_id', $owner->id)
            ->where('grantee_user_id', $grantee->id)
            ->update(['status' => 'revoked']);
    }
}

