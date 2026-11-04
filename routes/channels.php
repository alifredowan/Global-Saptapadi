<?php

use App\Models\FamilyRepresentative;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

/**
 * Real-Time Chaperoned Conversation Channel between User A and User B.
 * Authorized for:
 * 1. User A (Groom or Bride)
 * 2. User B (Bride or Groom)
 * 3. Authorized Family Representatives / Guardians of either seeker (e.g. Subhash for Priya)
 * 4. Platform Compliance Administrator
 */
Broadcast::channel('chat.{minId}.{maxId}', function ($user, $minId, $maxId) {
    $id1 = (int) $minId;
    $id2 = (int) $maxId;
    $currentId = (int) $user->id;

    // Platform Administrator
    if ($user->role === 'admin') {
        return true;
    }

    // Direct Seekers (Groom / Bride)
    if ($currentId === $id1 || $currentId === $id2) {
        return true;
    }

    // Authorized Guardian / Family Representative of either participant
    return FamilyRepresentative::whereIn('seeker_user_id', [$id1, $id2])
        ->where('rep_user_id', $currentId)
        ->exists();
});
