<?php

namespace App\Services;

use App\Models\User;
use App\Models\VivahMilestone;
use App\Models\Proposal;
use App\Models\PhotoAccessGrant;
use App\Models\AuditLog;
use Illuminate\Support\Str;

class CertificateService
{
    /**
     * Confirm a Vivah union milestone, generate Shubho Bibaho certificate,
     * and execute automated de-indexing lifecycle closure.
     */
    public function finalizeMarriageMilestone(VivahMilestone $milestone): VivahMilestone
    {
        $spouseA = $milestone->spouseA;
        $spouseB = $milestone->spouseB;

        // 1. Update milestone status
        $milestone->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);

        // 2. Update user statuses to 'married' (Strict Monogamy Mandate)
        $spouseA->update(['status' => 'married']);
        $spouseB->update(['status' => 'married']);

        // 3. Automated De-indexing: Immediately close all pending proposals involving either spouse
        Proposal::where(function ($q) use ($spouseA, $spouseB) {
            $q->whereIn('sender_user_id', [$spouseA->id, $spouseB->id])
              ->orWhereIn('receiver_user_id', [$spouseA->id, $spouseB->id]);
        })->whereNotIn('status', ['accepted'])->update([
            'status' => 'auto_closed_due_to_marriage'
        ]);

        // 4. Revoke third-party photo permissions
        PhotoAccessGrant::where(function ($q) use ($spouseA, $spouseB) {
            $q->whereIn('owner_user_id', [$spouseA->id, $spouseB->id])
              ->whereNotIn('grantee_user_id', [$spouseA->id, $spouseB->id]);
        })->update(['status' => 'revoked']);

        // 5. Generate certificate path reference
        $certUuid = $milestone->certificate_uuid;
        $certRelativePath = "certificates/shubho_bibaho_{$certUuid}.html";
        $milestone->update(['certificate_path' => $certRelativePath]);

        // 6. Audit Log
        AuditLog::log('vivah_milestone_confirmed', [
            'spouse_a' => $spouseA->id,
            'spouse_b' => $spouseB->id,
            'wedding_date' => $milestone->wedding_date,
            'certificate_uuid' => $certUuid,
        ], $spouseA->id);

        return $milestone;
    }

    /**
     * Render the HTML/SVG representation of the Shubho Bibaho certificate.
     */
    public function renderCertificateHtml(VivahMilestone $milestone): string
    {
        $spouseA = $milestone->spouseA;
        $spouseB = $milestone->spouseB;
        $weddingDate = $milestone->wedding_date ? $milestone->wedding_date->format('d/m/Y') : now()->format('d/m/Y');

        $groom = $spouseA->gender === 'male' ? $spouseA : $spouseB;
        $bride = $spouseA->gender === 'female' ? $spouseA : $spouseB;

        $groomGotra = $groom->profile?->gotra ?? 'Vedic Gotra';
        $brideGotra = $bride->profile?->gotra ?? 'Vedic Gotra';

        return view('certificates.shubho_bibaho', [
            'milestone' => $milestone,
            'groom' => $groom,
            'bride' => $bride,
            'groomGotra' => $groomGotra,
            'brideGotra' => $brideGotra,
            'weddingDate' => $weddingDate,
            'uuid' => $milestone->certificate_uuid,
        ])->render();
    }
}

