<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\SafetyFilterService;

class SafetyFilterAndDowryTest extends TestCase
{
    /**
     * URS FR-8.2: Automated real-time regex masking of telephone numbers, emails, social handles.
     */
    public function test_contact_shield_masks_phone_and_email(): void
    {
        $safetyFilter = new SafetyFilterService();

        $textWithPhone = "Namaskar, please call me at +12125550198 or +447911123456 tonight.";
        $shieldedPhone = $safetyFilter->applyContactShield($textWithPhone);
        $this->assertTrue($shieldedPhone['has_masked']);
        $this->assertStringNotContainsString('+12125550198', $shieldedPhone['masked']);
        $this->assertStringContainsString('[PHONE PROTECTED', $shieldedPhone['masked']);

        $textWithEmail = "Send me your details at sourav.test@gmail.com";
        $shieldedEmail = $safetyFilter->applyContactShield($textWithEmail);
        $this->assertTrue($shieldedEmail['has_masked']);
        $this->assertStringNotContainsString('sourav.test@gmail.com', $shieldedEmail['masked']);
        $this->assertStringContainsString('[EMAIL PROTECTED]', $shieldedEmail['masked']);
    }

    /**
     * URS FR-8.4 & Statutory Framework: Anti-dowry detection engine.
     * Complies with International Anti-Extortion Treaties and Global Anti-Dowry Legislation.
     */
    public function test_anti_dowry_detection_blocks_illicit_demands(): void
    {
        $safetyFilter = new SafetyFilterService();

        $dowryMessage = "We expect 20 lakh cash demand and 50 bhori gold as dowry for marriage.";
        $result = $safetyFilter->processChatMessage($dowryMessage);

        $this->assertTrue($result['blocked']);
        $this->assertTrue($result['dowry_flagged']);
        $this->assertStringContainsString('Anti-Dowry', $result['displayed_content']);
    }

    public function test_respectful_messages_are_unblocked(): void
    {
        $safetyFilter = new SafetyFilterService();

        $cleanMessage = "Pranam. We are very pleased to learn about your family and devotional practices.";
        $result = $safetyFilter->processChatMessage($cleanMessage);

        $this->assertFalse($result['blocked']);
        $this->assertFalse($result['dowry_flagged']);
        $this->assertEquals($cleanMessage, $result['displayed_content']);
    }
}

