<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Profile;
use App\Models\Proposal;
use App\Models\VivahMilestone;
use App\Services\CertificateService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VivahMilestoneAndProposalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * URS FR-7.3: Proposal acceptance unlocks mutual photo access.
     */
    public function test_proposal_acceptance_unlocks_mutual_photo_access(): void
    {
        $groom = User::create([
            'name' => 'Sourav Banerjee',
            'email' => 'sourav@example.com',
            'phone' => '+8801700000010',
            'gender' => 'male',
            'date_of_birth' => '1995-05-10',
            'role' => 'groom',
            'password' => 'password123',
        ]);
        Profile::create(['user_id' => $groom->id, 'photo_privacy' => 'blur_until_mutual']);

        $bride = User::create([
            'name' => 'Debolina Roy',
            'email' => 'debolina@example.com',
            'phone' => '+8801700000011',
            'gender' => 'female',
            'date_of_birth' => '1998-08-15',
            'role' => 'bride',
            'password' => 'password123',
        ]);
        Profile::create(['user_id' => $bride->id, 'photo_privacy' => 'blur_until_mutual']);

        // Before proposal acceptance, mutual interest is false and photo is blurred
        $this->assertFalse($groom->hasMutualInterestWith($bride->id));
        $this->assertFalse($groom->canViewUnblurredPhotoOf($bride));

        // Create proposal sent by groom to bride
        $proposal = Proposal::create([
            'sender_user_id' => $groom->id,
            'receiver_user_id' => $bride->id,
            'introductory_note' => 'Namaskar, we would be pleased to connect.',
            'status' => 'pending',
        ]);

        // Bride accepts proposal
        $this->actingAs($bride)->post("/proposals/{$proposal->id}/accept");

        // Verify mutual interest is true and unblurred photo is accessible
        $proposal->refresh();
        $this->assertEquals('accepted', $proposal->status);
        $this->assertTrue($groom->hasMutualInterestWith($bride->id));
        $this->assertTrue($groom->canViewUnblurredPhotoOf($bride));
        $this->assertTrue($bride->canViewUnblurredPhotoOf($groom));
    }

    /**
     * URS FR-11.1, FR-11.2, FR-11.3: Marriage declaration, Shubho Bibaho certificate,
     * and automated de-indexing (status changed to married, outstanding proposals auto-closed).
     */
    public function test_marriage_milestone_and_automated_deindexing(): void
    {
        $certService = new CertificateService();

        $groom = User::create([
            'name' => 'Amit Sen',
            'email' => 'amit@example.com',
            'phone' => '+8801700000020',
            'gender' => 'male',
            'date_of_birth' => '1994-03-12',
            'role' => 'groom',
            'status' => 'active',
            'password' => 'password123',
        ]);
        Profile::create(['user_id' => $groom->id, 'gotra' => 'Shandilya']);

        $bride = User::create([
            'name' => 'Rupa Mukherjee',
            'email' => 'rupa@example.com',
            'phone' => '+8801700000021',
            'gender' => 'female',
            'date_of_birth' => '1997-07-20',
            'role' => 'bride',
            'status' => 'active',
            'password' => 'password123',
        ]);
        Profile::create(['user_id' => $bride->id, 'gotra' => 'Kashyapa']);

        $otherSuitor = User::create([
            'name' => 'Other Suitor',
            'email' => 'other@example.com',
            'phone' => '+8801700000022',
            'gender' => 'male',
            'date_of_birth' => '1993-01-01',
            'role' => 'groom',
            'status' => 'active',
            'password' => 'password123',
        ]);

        // Proposal between other suitor and bride is pending
        $pendingProposal = Proposal::create([
            'sender_user_id' => $otherSuitor->id,
            'receiver_user_id' => $bride->id,
            'status' => 'pending',
        ]);

        // Marriage milestone created between Amit and Rupa
        $milestone = VivahMilestone::create([
            'spouse_a_user_id' => $groom->id,
            'spouse_b_user_id' => $bride->id,
            'wedding_date' => Carbon::now()->toDateString(),
            'certificate_uuid' => (string) Str::uuid(),
            'status' => 'pending_confirmation',
        ]);

        // Finalize marriage
        $certService->finalizeMarriageMilestone($milestone);

        // Verify status is married (Strict Monogamy)
        $groom->refresh();
        $bride->refresh();
        $this->assertEquals('married', $groom->status);
        $this->assertEquals('married', $bride->status);

        // Verify automated deindexing closed other proposals
        $pendingProposal->refresh();
        $this->assertEquals('auto_closed_due_to_marriage', $pendingProposal->status);
    }
}

