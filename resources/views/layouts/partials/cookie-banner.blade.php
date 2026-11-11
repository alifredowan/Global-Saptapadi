@php
    $compliance = \App\Services\ComplianceService::getSettings();
@endphp

<!-- International Cookie Consent Dialog (GDPR, ePrivacy & DPDP Compliant) -->
<div x-data="{
    showBanner: false,
    showCustomize: false,
    analytics: false,
    marketing: false,

    init() {
        const stored = this.getConsent();
        if (!stored) {
            setTimeout(() => { this.showBanner = true; }, 350);
        } else {
            this.applyConsent(stored);
        }

        window.addEventListener('open-cookie-settings', () => {
            const current = this.getConsent() || { analytics: false, marketing: false };
            this.analytics = current.analytics || false;
            this.marketing = current.marketing || false;
            this.showCustomize = true;
            this.showBanner = true;
        });
    },

    getConsent() {
        try {
            const raw = localStorage.getItem('saptapadi_cookie_consent') || localStorage.getItem('vivah_cookie_consent');
            if (raw) {
                if (raw === 'all') return { essential: true, analytics: true, marketing: true };
                if (raw === 'essential') return { essential: true, analytics: false, marketing: false };
                return JSON.parse(raw);
            }
        } catch (e) {}
        return null;
    },

    saveConsent(data) {
        try {
            const payload = JSON.stringify(data);
            localStorage.setItem('saptapadi_cookie_consent', payload);
            // 12 months cookie expiry
            const d = new Date();
            d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
            document.cookie = 'saptapadi_cookie_consent=' + encodeURIComponent(payload) + '; expires=' + d.toUTCString() + '; path=/; SameSite=Lax';
        } catch (e) {}

        this.applyConsent(data);
        this.showBanner = false;
        this.showCustomize = false;
    },

    applyConsent(data) {
        window.__analyticsOptIn = !!data.analytics;
        window.__marketingOptIn = !!data.marketing;
        window.dispatchEvent(new CustomEvent('cookie-consent-updated', { detail: data }));
    },

    acceptAll() {
        this.analytics = true;
        this.marketing = true;
        this.saveConsent({ essential: true, analytics: true, marketing: true, timestamp: Date.now() });
    },

    rejectNonEssential() {
        this.analytics = false;
        this.marketing = false;
        this.saveConsent({ essential: true, analytics: false, marketing: false, timestamp: Date.now() });
    },

    saveChoices() {
        this.saveConsent({
            essential: true,
            analytics: this.analytics,
            marketing: this.marketing,
            timestamp: Date.now()
        });
    }
}"
x-show="showBanner"
x-cloak
x-transition:enter="transition ease-out duration-200"
x-transition:enter-start="opacity-0 translate-y-4"
x-transition:enter-end="opacity-100 translate-y-0"
x-transition:leave="transition ease-in duration-150"
x-transition:leave-start="opacity-100 translate-y-0"
x-transition:leave-end="opacity-0 translate-y-4"
role="dialog"
aria-labelledby="cookie-banner-title"
aria-modal="true"
class="fixed bottom-0 left-0 right-0 sm:bottom-6 sm:left-6 sm:right-auto z-50 w-full sm:max-w-[420px] bg-[var(--bg-surface)] border-t sm:border border-[var(--border-strong)] sm:rounded-[var(--radius-lg)] p-4 sm:p-5 shadow-2xl shadow-stone-950/20 text-stone-900 dark:text-stone-100">

    <!-- 1. Compact Initial Banner -->
    <div x-show="!showCustomize" class="space-y-3">
        <div class="flex items-start justify-between gap-3">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[var(--secondary-primary)]"></span>
                <h4 id="cookie-banner-title" class="font-serif font-bold text-sm text-[var(--text-primary)]">
                    {{ $compliance['banner_heading'] ?? 'Your privacy, your choice' }}
                </h4>
            </div>
            <button type="button" @click="rejectNonEssential()" class="text-[var(--text-muted)] hover:text-[var(--text-primary)] text-xs p-1" title="Dismiss with essential cookies">
                ✕
            </button>
        </div>

        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
            {{ $compliance['banner_text'] ?? 'We use a few cookies to keep you signed in and understand how the site is used. You choose what we can use.' }}
            <a href="{{ route('cookie.policy') }}" class="font-medium text-[var(--accent-primary)] hover:underline ml-1">
                Read cookie policy
            </a>.
        </p>

        <!-- Action Buttons: Same size and prominence -->
        <div class="pt-1 flex flex-col gap-2">
            <div class="grid grid-cols-2 gap-2">
                <button type="button"
                        @click="acceptAll()"
                        class="btn-primary !min-h-[40px] !h-[40px] !text-xs font-semibold w-full">
                    Accept all
                </button>

                <button type="button"
                        @click="rejectNonEssential()"
                        class="btn-secondary !min-h-[40px] !h-[40px] !text-xs font-semibold w-full">
                    Reject non-essential
                </button>
            </div>

            <button type="button"
                    @click="showCustomize = true"
                    class="text-xs font-medium text-[var(--text-secondary)] hover:text-[var(--accent-primary)] text-center py-1 transition cursor-pointer">
                Customize choices &rarr;
            </button>
        </div>
    </div>

    <!-- 2. Customize Panel with Toggles -->
    <div x-show="showCustomize" x-cloak class="space-y-4">
        <div class="flex items-center justify-between pb-2 border-b border-[var(--border-subtle)]">
            <h4 class="font-serif font-bold text-sm text-[var(--text-primary)]">
                Cookie Preferences
            </h4>
            <button type="button" @click="showCustomize = false" class="text-xs text-[var(--text-muted)] hover:text-[var(--text-primary)]">
                &larr; Back
            </button>
        </div>

        <div class="space-y-3 max-h-64 overflow-y-auto pr-1 text-xs">
            <!-- Essential -->
            <div class="p-2.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] flex items-start justify-between gap-3">
                <div class="space-y-0.5">
                    <span class="font-bold text-[var(--text-primary)] block">Essential Cookies</span>
                    <p class="text-[11px] text-[var(--text-secondary)]">Required for session authentication and security. Cannot be disabled.</p>
                </div>
                <input type="checkbox" checked disabled class="mt-1 rounded text-[var(--color-success)] cursor-not-allowed">
            </div>

            <!-- Analytics -->
            <label class="p-2.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] flex items-start justify-between gap-3 cursor-pointer">
                <div class="space-y-0.5">
                    <span class="font-bold text-[var(--text-primary)] block">Analytics Cookies</span>
                    <p class="text-[11px] text-[var(--text-secondary)]">Helps us understand discovery flow and improve family matchmaking.</p>
                </div>
                <input type="checkbox" x-model="analytics" class="mt-1 rounded text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
            </label>

            <!-- Marketing -->
            <label class="p-2.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] flex items-start justify-between gap-3 cursor-pointer">
                <div class="space-y-0.5">
                    <span class="font-bold text-[var(--text-primary)] block">Marketing &amp; Outreach</span>
                    <p class="text-[11px] text-[var(--text-secondary)]">Anonymous outreach performance to diaspora communities.</p>
                </div>
                <input type="checkbox" x-model="marketing" class="mt-1 rounded text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
            </label>
        </div>

        <div class="pt-1 flex items-center justify-between gap-2 border-t border-[var(--border-subtle)]">
            <a href="{{ route('privacy.policy') }}" class="text-[11px] text-[var(--text-muted)] hover:underline">
                Privacy Policy
            </a>
            <button type="button"
                    @click="saveChoices()"
                    class="btn-primary !min-h-[38px] !h-[38px] !px-4 !text-xs font-semibold">
                Save choices
            </button>
        </div>
    </div>

</div>
