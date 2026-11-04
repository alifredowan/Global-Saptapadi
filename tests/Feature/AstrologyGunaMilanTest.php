<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\AstrologyService;
use App\Models\Kundli;

class AstrologyGunaMilanTest extends TestCase
{
    /**
     * URS FR-3.3: Automated 36-point Ashtakoota Guna Milan calculation.
     */
    public function test_guna_milan_calculation_accuracy(): void
    {
        $astrologyService = new AstrologyService();

        $groomKundli = new Kundli([
            'rashi' => 'Mesha',
            'nakshatra' => 'Ashwini',
            'manglik_status' => 'non_manglik',
        ]);

        $brideKundli = new Kundli([
            'rashi' => 'Simha',
            'nakshatra' => 'Magha',
            'manglik_status' => 'non_manglik',
        ]);

        $result = $astrologyService->calculateGunaMilan($groomKundli, $brideKundli);

        $this->assertArrayHasKey('total_score', $result);
        $this->assertArrayHasKey('breakdown', $result);
        $this->assertEquals(36, $result['max_score']);
        $this->assertGreaterThanOrEqual(0, $result['total_score']);
        $this->assertLessThanOrEqual(36, $result['total_score']);

        // Check 8 Kootas exist
        $breakdown = $result['breakdown'];
        $this->assertArrayHasKey('varna', $breakdown);
        $this->assertArrayHasKey('vashya', $breakdown);
        $this->assertArrayHasKey('tara', $breakdown);
        $this->assertArrayHasKey('yoni', $breakdown);
        $this->assertArrayHasKey('graha_maitri', $breakdown);
        $this->assertArrayHasKey('gana', $breakdown);
        $this->assertArrayHasKey('bhakoot', $breakdown);
        $this->assertArrayHasKey('nadi', $breakdown);
    }

    /**
     * URS FR-3.4: Clear Manglik status indicator and dosha cancellation.
     */
    public function test_manglik_cancellation_logic(): void
    {
        $astrologyService = new AstrologyService();

        $bothManglik = $astrologyService->analyzeManglik(
            new Kundli(['manglik_status' => 'manglik']),
            new Kundli(['manglik_status' => 'manglik'])
        );
        $this->assertTrue($bothManglik['match']);
        $this->assertStringContainsString('Cancelled', $bothManglik['label']);

        $singleManglik = $astrologyService->analyzeManglik(
            new Kundli(['manglik_status' => 'manglik']),
            new Kundli(['manglik_status' => 'non_manglik'])
        );
        $this->assertFalse($singleManglik['match']);
        $this->assertEquals('warning', $singleManglik['severity']);
    }

    /**
     * URS FR-3.6: Automated same-gotra advisory warning notice.
     */
    public function test_same_gotra_warning_advisory(): void
    {
        $astrologyService = new AstrologyService();

        // Both share Shandilya gotra
        $advisory = $astrologyService->checkGotraAdvisory('Shandilya', 'Shandilya');
        $this->assertTrue($advisory['has_advisory']);
        $this->assertEquals('paternal_same_gotra', $advisory['type']);

        // Distinct gotras
        $clear = $astrologyService->checkGotraAdvisory('Shandilya', 'Kashyapa');
        $this->assertFalse($clear['has_advisory']);
    }
}

