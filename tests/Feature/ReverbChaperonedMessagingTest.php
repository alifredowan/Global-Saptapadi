<?php

namespace Tests\Feature;

use App\Events\MessageSent;
use App\Models\FamilyRepresentative;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ReverbChaperonedMessagingTest extends TestCase
{
    use RefreshDatabase;

    public function test_groom_and_bride_messaging_dispatches_reverb_event(): void
    {
        Event::fake([MessageSent::class]);

        $groom = User::factory()->create([
            'role' => 'groom',
            'gender' => 'male',
            'date_of_birth' => '1995-01-01',
        ]);

        $bride = User::factory()->create([
            'role' => 'bride',
            'gender' => 'female',
            'date_of_birth' => '1998-01-01',
        ]);

        // Mutual accepted proposal
        Proposal::create([
            'sender_user_id' => $groom->id,
            'receiver_user_id' => $bride->id,
            'status' => 'accepted',
        ]);

        $response = $this->actingAs($groom)->post(route('chat.send', $bride->id), [
            'content' => 'Namaskar! Glad to connect with you.',
        ]);

        $response->assertSessionHas('success');

        Event::assertDispatched(MessageSent::class, function ($event) use ($groom, $bride) {
            $min = min($groom->id, $bride->id);
            $max = max($groom->id, $bride->id);
            return $event->broadcastOn()[0]->name === 'private-chat.'.$min.'.'.$max
                && $event->broadcastWith()['is_guardian'] === false
                && $event->broadcastWith()['sender_name'] === $groom->name;
        });
    }

    public function test_family_guardian_can_participate_in_chaperoned_messaging(): void
    {
        Event::fake([MessageSent::class]);

        $groom = User::factory()->create([
            'role' => 'groom',
            'gender' => 'male',
            'date_of_birth' => '1995-01-01',
        ]);

        $bride = User::factory()->create([
            'role' => 'bride',
            'gender' => 'female',
            'date_of_birth' => '1998-01-01',
        ]);

        $guardian = User::factory()->create([
            'role' => 'family_rep',
            'gender' => 'male',
            'date_of_birth' => '1965-01-01',
        ]);

        // Link guardian to bride
        FamilyRepresentative::create([
            'seeker_user_id' => $bride->id,
            'rep_user_id' => $guardian->id,
            'relationship' => 'Father',
            'permission_scope' => 'approval_required',
            'is_verified' => true,
        ]);

        Proposal::create([
            'sender_user_id' => $groom->id,
            'receiver_user_id' => $bride->id,
            'status' => 'accepted',
        ]);

        // Guardian sends chaperone guidance message
        $response = $this->actingAs($guardian)->post(route('chat.send', $groom->id), [
            'content' => 'Namaskar Arun Babu, our family blesses this conversation.',
        ]);

        $response->assertSessionHas('success');

        Event::assertDispatched(MessageSent::class, function ($event) use ($guardian) {
            $data = $event->broadcastWith();
            return $data['is_guardian'] === true
                && $data['sender_name'] === $guardian->name
                && str_contains($data['guardian_title'], 'Guardian');
        });
    }
}

