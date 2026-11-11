<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\AuditLog;

class ComplianceService
{
    protected static string $filePath = 'compliance.json';

    public static function defaults(): array
    {
        return [
            'banner_heading' => 'Your privacy, your choice',
            'banner_text' => 'We use a few cookies to keep you signed in and understand how the site is used. You choose what we can use.',
            'policy_url' => '/cookie-policy',
            'privacy_url' => '/privacy-policy',
            'terms_url' => '/terms',
            'categories' => [
                'essential' => [
                    'title' => 'Essential Cookies',
                    'description' => 'Required for session authentication, security (CSRF), and saved interface preferences. Always active.',
                    'locked' => true,
                    'default' => true,
                ],
                'analytics' => [
                    'title' => 'Analytics Cookies',
                    'description' => 'Aggregated, anonymous usage analytics to help refine family match discovery and site performance.',
                    'locked' => false,
                    'default' => false,
                ],
                'marketing' => [
                    'title' => 'Marketing & Communications',
                    'description' => 'Helps us reach diaspora families seeking respectful matrimonial connections.',
                    'locked' => false,
                    'default' => false,
                ],
            ],
            'updated_at' => '2026-11-11 12:00:00',
        ];
    }

    public static function getSettings(): array
    {
        try {
            if (Storage::disk('local')->exists(self::$filePath)) {
                $content = Storage::disk('local')->get(self::$filePath);
                $decoded = json_decode($content, true);
                if (is_array($decoded)) {
                    return array_merge(self::defaults(), $decoded);
                }
            }
        } catch (\Throwable $e) {}

        return self::defaults();
    }

    public static function updateSettings(array $data, ?int $adminUserId = null): array
    {
        $current = self::getSettings();
        $updated = array_merge($current, [
            'banner_heading' => $data['banner_heading'] ?? $current['banner_heading'],
            'banner_text' => $data['banner_text'] ?? $current['banner_text'],
            'policy_url' => $data['policy_url'] ?? $current['policy_url'],
            'privacy_url' => $data['privacy_url'] ?? $current['privacy_url'],
            'terms_url' => $data['terms_url'] ?? $current['terms_url'],
            'updated_at' => now()->toDateTimeString(),
        ]);

        if (isset($data['categories']) && is_array($data['categories'])) {
            foreach ($data['categories'] as $catKey => $catData) {
                if (isset($updated['categories'][$catKey])) {
                    if (isset($catData['title'])) $updated['categories'][$catKey]['title'] = $catData['title'];
                    if (isset($catData['description'])) $updated['categories'][$catKey]['description'] = $catData['description'];
                }
            }
        }

        Storage::disk('local')->put(self::$filePath, json_encode($updated, JSON_PRETTY_PRINT));

        if ($adminUserId) {
            AuditLog::log('compliance_settings_updated', ['updated_fields' => array_keys($data)], $adminUserId);
        }

        return $updated;
    }
}

