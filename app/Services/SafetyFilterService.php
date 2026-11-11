<?php

namespace App\Services;

class SafetyFilterService
{
    /**
     * Anti-Dowry & Anti-Extortion Prohibited Keywords and Semantic Phrases
     * In compliance with International Anti-Extortion Treaties, UN CEDAW, and Global Anti-Dowry Legislation
     */
    protected const DOWRY_PATTERNS = [
        '/\b(dowry|dahej|paun|pon|joutuk|joutuker|demand\s+money|cash\s+demand)\b/i',
        '/\b(give\s+us|demand|expecting)\s+(\d+|\w+)?\s*(lakh|crore|gold|car|flat|apartment|money|cash)\b/i',
        '/\b(how\s+much\s+(gold|cash|money|bhori|tola|land))\b/i',
        '/\b(joutuk\s+dite\s+hobe|dahej\s+chahiye|taka\s+lagbe|shona\s+lagbe)\b/i',
        '/\b(transfer\s+(property|assets|shares|plot|flat))\b/i',
        '/\b(wedding\s+expenses\s+borne\s+fully\s+by\s+girl)\b/i',
    ];

    /**
     * Contact shielding regex patterns:
     * - International and local telephone formats (+880, +91, 017..., 98..., etc.)
     * - Spelled-out digit words ("zero one seven...", "nine eight four...")
     * - Email addresses
     * - Social media handles: WhatsApp, FB, Instagram, Telegram, IMO
     */
    protected const PHONE_PATTERNS = [
        '/(\+?[0-9]{1,4}[\s\-\.]?)?(\(?\d{2,4}\)?[\s\-\.]?)?\d{3,4}[\s\-\.]?\d{3,4}/',
        '/\b(zero|one|two|three|four|five|six|seven|eight|nine)(\s+(zero|one|two|three|four|five|six|seven|eight|nine)){4,}\b/i',
        '/\b(shunno|ek|dui|tin|char|pach|chhoy|shaat|aat|noy)(\s+(shunno|ek|dui|tin|char|pach|chhoy|shaat|aat|noy)){4,}\b/i',
    ];

    protected const EMAIL_PATTERN = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';

    protected const SOCIAL_HANDLE_PATTERNS = [
        '/\b(whatsapp|wa\.me|wa|imo|viber|telegram|tg|insta|instagram|ig|fb|facebook)\s*(id|handle|number|no|:)?\s*[:\-@]?\s*[\w\.\+]{4,}/i',
        '/@[a-zA-Z0-9_]{4,}/',
    ];

    protected const PROFANITY_PATTERNS = [
        '/\b(abuse|slur|vulgar|bastard|idiot|harass|scam|fraud)\b/i',
    ];

    /**
     * Inspect message for dowry violations.
     */
    public function scanForDowry(string $message): array
    {
        foreach (self::DOWRY_PATTERNS as $pattern) {
            if (preg_match($pattern, $message, $matches)) {
                return [
                    'flagged' => true,
                    'violation' => 'dowry_solicitation',
                    'matched_term' => $matches[0],
                    'reason' => 'Message triggered statutory anti-dowry & anti-extortion filter. Commercial, asset, and dowry demands are strictly prohibited under international matrimonial laws and Global Saptapadi global ethics.',
                ];
            }
        }

        return ['flagged' => false];
    }

    /**
     * Mask contact information (phone, email, social handles) for Contact Shield.
     */
    public function applyContactShield(string $message): array
    {
        $masked = $message;
        $hasMasked = false;

        // 1. Mask emails
        if (preg_match(self::EMAIL_PATTERN, $masked)) {
            $masked = preg_replace(self::EMAIL_PATTERN, '[EMAIL PROTECTED]', $masked);
            $hasMasked = true;
        }

        // 2. Mask phone numbers
        foreach (self::PHONE_PATTERNS as $pattern) {
            if (preg_match($pattern, $masked)) {
                $masked = preg_replace($pattern, '[PHONE PROTECTED - USE MUTUAL CONTACT EXCHANGE]', $masked);
                $hasMasked = true;
            }
        }

        // 3. Mask social media handles
        foreach (self::SOCIAL_HANDLE_PATTERNS as $pattern) {
            if (preg_match($pattern, $masked)) {
                $masked = preg_replace($pattern, '[HANDLE PROTECTED]', $masked);
                $hasMasked = true;
            }
        }

        return [
            'original' => $message,
            'masked' => $masked,
            'has_masked' => $hasMasked,
        ];
    }

    /**
     * Process message before saving/transmitting:
     * Returns sanitized output and security flags.
     */
    public function processChatMessage(string $content): array
    {
        // Dowry check
        $dowryCheck = $this->scanForDowry($content);
        if ($dowryCheck['flagged']) {
            return [
                'blocked' => true,
                'dowry_flagged' => true,
                'dowry_details' => $dowryCheck['reason'],
                'message_content' => $content,
                'displayed_content' => '[BLOCKED: Violation of Statutory Anti-Dowry Policy]',
                'has_masked_contacts' => false,
            ];
        }

        // Contact shielding
        $shieldResult = $this->applyContactShield($content);

        return [
            'blocked' => false,
            'dowry_flagged' => false,
            'dowry_details' => null,
            'message_content' => $content,
            'displayed_content' => $shieldResult['masked'],
            'has_masked_contacts' => $shieldResult['has_masked'],
        ];
    }
}

