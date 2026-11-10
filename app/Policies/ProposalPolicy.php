<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Proposal;

class ProposalPolicy
{
    /**
     * Determine whether the user can view the proposal.
     */
    public function view(User $user, Proposal $proposal): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->id === $proposal->sender_user_id || $user->id === $proposal->receiver_user_id) {
            return true;
        }

        // Family Representatives linked to either seeker
        return $user->familyWards()->whereIn('seeker_user_id', [$proposal->sender_user_id, $proposal->receiver_user_id])->exists();
    }

    /**
     * Determine whether the user can respond to (accept/decline) the proposal.
     */
    public function respond(User $user, Proposal $proposal): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        // Receiver can always respond
        if ($user->id === $proposal->receiver_user_id) {
            return true;
        }

        // Family representative with approval rights for the receiver
        return $user->familyWards()
            ->where('seeker_user_id', $proposal->receiver_user_id)
            ->whereIn('permission_scope', ['approval_required', 'full_representation'])
            ->exists();
    }
}

