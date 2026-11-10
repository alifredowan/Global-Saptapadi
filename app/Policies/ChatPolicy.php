<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Proposal;

class ChatPolicy
{
    /**
     * Determine whether the user can enter the chat room with a partner.
     */
    public function enter(User $user, User $partner): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        // Direct seekers: require mutual accepted proposal
        if ($user->hasMutualInterestWith($partner->id)) {
            return true;
        }

        // Guardian check: if user is guardian of someone who has mutual accepted proposal with partner
        return $user->familyWards()
            ->whereHas('sentProposals', fn($q) => $q->where('receiver_user_id', $partner->id)->where('status', 'accepted'))
            ->orWhereHas('receivedProposals', fn($q) => $q->where('sender_user_id', $partner->id)->where('status', 'accepted'))
            ->exists();
    }
}

