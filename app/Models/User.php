<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'date_of_birth' => 'date',
            'is_verified' => 'boolean',
            'anti_bot_verified' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function kundli()
    {
        return $this->hasOne(Kundli::class);
    }

    public function partnerPreference()
    {
        return $this->hasOne(PartnerPreference::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('is_primary', 'desc')->orderBy('sort_order', 'asc');
    }

    public function familyRepresentatives()
    {
        return $this->hasMany(FamilyRepresentative::class, 'seeker_user_id')->with('representativeUser');
    }

    public function representedSeekers()
    {
        return $this->hasMany(FamilyRepresentative::class, 'rep_user_id')->with('seekerUser.profile');
    }

    public function sentProposals()
    {
        return $this->hasMany(Proposal::class, 'sender_user_id');
    }

    public function receivedProposals()
    {
        return $this->hasMany(Proposal::class, 'receiver_user_id');
    }

    public function identityVerification()
    {
        return $this->hasOne(IdentityVerification::class);
    }

    public function shortlists()
    {
        return $this->hasMany(Shortlist::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(MembershipSubscription::class);
    }

    public function dailyActivities()
    {
        return $this->hasMany(DailyActivity::class);
    }

    public function vivahMilestones()
    {
        return $this->hasMany(VivahMilestone::class, 'spouse_a_user_id')
            ->orWhere('spouse_b_user_id', $this->id);
    }

    public function isPro(): bool
    {
        return $this->membership_tier === 'pro';
    }

    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null;
    }

    public function getPrimaryPhotoUrlAttribute(): string
    {
        $primary = $this->photos()->where('is_primary', true)->first();
        if ($primary && file_exists(public_path($primary->photo_path))) {
            return asset($primary->photo_path);
        }
        return $this->gender === 'female' 
            ? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=80'
            : 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80';
    }

    public function getBlurredPhotoUrlAttribute(): string
    {
        $primary = $this->photos()->where('is_primary', true)->first();
        if ($primary && $primary->blurred_photo_path && file_exists(public_path($primary->blurred_photo_path))) {
            return asset($primary->blurred_photo_path);
        }
        // Fallback blurred representation
        return 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=10&blur=50';
    }

    public function hasMutualInterestWith(int $otherUserId): bool
    {
        return Proposal::where(function ($q) use ($otherUserId) {
            $q->where('sender_user_id', $this->id)->where('receiver_user_id', $otherUserId);
        })->orWhere(function ($q) use ($otherUserId) {
            $q->where('sender_user_id', $otherUserId)->where('receiver_user_id', $this->id);
        })->where('status', 'accepted')->exists();
    }

    public function canViewUnblurredPhotoOf(User $candidate): bool
    {
        // Own photo
        if ($this->id === $candidate->id) {
            return true;
        }

        // Admin can always view
        if ($this->role === 'admin') {
            return true;
        }

        $privacy = $candidate->profile?->photo_privacy ?? 'blur_until_mutual';

        if ($privacy === 'public') {
            return true;
        }

        if ($privacy === 'blur_until_mutual') {
            return $this->hasMutualInterestWith($candidate->id);
        }

        if ($privacy === 'restricted') {
            return PhotoAccessGrant::where('owner_user_id', $candidate->id)
                ->where('grantee_user_id', $this->id)
                ->where('status', 'granted')
                ->exists();
        }

        return false;
    }

    public function canSendProposalToday(): bool
    {
        if ($this->isPro()) return true;

        $activity = DailyActivity::firstOrCreate(
            ['user_id' => $this->id, 'activity_date' => Carbon::today()->toDateString()],
            ['interests_sent_count' => 0, 'profiles_viewed_count' => 0]
        );

        return $activity->interests_sent_count < 5;
    }

    public function incrementDailyProposal(): void
    {
        $activity = DailyActivity::firstOrCreate(
            ['user_id' => $this->id, 'activity_date' => Carbon::today()->toDateString()],
            ['interests_sent_count' => 0, 'profiles_viewed_count' => 0]
        );
        $activity->increment('interests_sent_count');
    }

    public function canViewProfileToday(): bool
    {
        if ($this->isPro()) return true;

        $activity = DailyActivity::firstOrCreate(
            ['user_id' => $this->id, 'activity_date' => Carbon::today()->toDateString()],
            ['interests_sent_count' => 0, 'profiles_viewed_count' => 0]
        );

        return $activity->profiles_viewed_count < 10;
    }

    public function incrementDailyProfileView(): void
    {
        $activity = DailyActivity::firstOrCreate(
            ['user_id' => $this->id, 'activity_date' => Carbon::today()->toDateString()],
            ['interests_sent_count' => 0, 'profiles_viewed_count' => 0]
        );
        $activity->increment('profiles_viewed_count');
    }
}
