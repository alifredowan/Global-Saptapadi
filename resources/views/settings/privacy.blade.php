@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 py-6">

    <!-- Header -->
    <div class="border-b border-[var(--border-default)] pb-4">
        <span class="text-xs font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Settings &amp; Preferences</span>
        <h1 class="text-2xl sm:text-3xl font-bold font-serif text-[var(--text-primary)]">
            Privacy &amp; Data Control
        </h1>
        <p class="text-xs sm:text-sm text-[var(--text-secondary)] mt-1">
            Manage your photo visibility, contact privacy shields, and tracking consent.
        </p>
    </div>

    @if(session('success'))
        <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-xs font-semibold text-[var(--color-success)] flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form: Photo Privacy Settings -->
    <form action="{{ route('settings.privacy.update') }}" method="POST" class="card-ledger p-6 space-y-6">
        @csrf
        
        <div class="space-y-1">
            <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">Photo Privacy Shields</h3>
            <p class="text-xs text-[var(--text-secondary)]">Choose when prospective candidates and family guardians can view your full portrait photographs.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <label class="p-3.5 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'blur_until_mutual' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] font-semibold' : 'bg-[var(--bg-surface)] border-[var(--border-default)]' }}">
                <input type="radio" name="photo_privacy" value="blur_until_mutual" {{ $profile->photo_privacy === 'blur_until_mutual' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                <span class="block mt-2 text-xs font-bold text-[var(--text-primary)]">Mutual Interest Only</span>
                <span class="block text-[11px] text-[var(--text-secondary)] mt-1">Photos stay softly veiled until both sides formally accept a proposal.</span>
            </label>

            <label class="p-3.5 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'public' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] font-semibold' : 'bg-[var(--bg-surface)] border-[var(--border-default)]' }}">
                <input type="radio" name="photo_privacy" value="public" {{ $profile->photo_privacy === 'public' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                <span class="block mt-2 text-xs font-bold text-[var(--text-primary)]">Verified Members</span>
                <span class="block text-[11px] text-[var(--text-secondary)] mt-1">Visible to candidates and family elders with approved government IDs.</span>
            </label>

            <label class="p-3.5 rounded-[var(--radius-sm)] border cursor-pointer transition {{ $profile->photo_privacy === 'restricted' ? 'bg-[var(--accent-subtle)] border-[var(--accent-border)] font-semibold' : 'bg-[var(--bg-surface)] border-[var(--border-default)]' }}">
                <input type="radio" name="photo_privacy" value="restricted" {{ $profile->photo_privacy === 'restricted' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                <span class="block mt-2 text-xs font-bold text-[var(--text-primary)]">Direct Permission Only</span>
                <span class="block text-[11px] text-[var(--text-secondary)] mt-1">Requires an explicit photo access request granted by you or your elder.</span>
            </label>
        </div>

        <div class="pt-2 flex justify-end">
            <button type="submit" class="btn-primary !min-h-[44px] !text-xs">
                Save Privacy Preferences
            </button>
        </div>
    </form>

    <!-- Cookie Consent & Tracking Preferences Card -->
    <div class="card-ledger p-6 space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-[var(--border-subtle)]">
            <div>
                <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">Cookie &amp; Tracking Consent</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5">Under ePrivacy and DPDP, you have full control over non-essential tracking.</p>
            </div>
            <button type="button" @click="window.dispatchEvent(new CustomEvent('open-cookie-settings'))" class="btn-secondary !min-h-[44px] !text-xs">
                Manage Cookie Settings
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)]">
                <span class="font-bold text-[var(--text-primary)] block">Essential Cookies</span>
                <span class="text-[11px] text-[var(--color-success)] font-semibold block mt-0.5">Always Enabled</span>
                <p class="text-[11px] text-[var(--text-secondary)] mt-1">Maintains authenticated session, anti-forgery tokens, and theme settings.</p>
            </div>
            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)]">
                <span class="font-bold text-[var(--text-primary)] block">Analytics Cookies</span>
                <span class="text-[11px] text-[var(--secondary-text)] font-semibold block mt-0.5">Configurable</span>
                <p class="text-[11px] text-[var(--text-secondary)] mt-1">Aggregated discovery flow metrics. Blocked unless opted in.</p>
            </div>
            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)]">
                <span class="font-bold text-[var(--text-primary)] block">Marketing Cookies</span>
                <span class="text-[11px] text-[var(--text-muted)] font-semibold block mt-0.5">Configurable</span>
                <p class="text-[11px] text-[var(--text-secondary)] mt-1">Community outreach metrics across diaspora regions. Zero third-party sale.</p>
            </div>
        </div>
    </div>

    <!-- Data Rights & Account Erasure -->
    <div class="card-ledger p-6 border-[var(--color-danger-border)] bg-[var(--color-danger-bg)] space-y-3">
        <h3 class="font-serif font-bold text-base text-[var(--color-danger)]">Account Erasure (Right to Be Forgotten)</h3>
        <p class="text-xs text-[var(--text-secondary)]">
            Permanently erases your biodata, photos, proposals, and identity documents across all platform databases. This action is immediate and non-reversible.
        </p>
        <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently erase your profile and all associated data? This cannot be undone.');">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-[var(--radius-sm)] bg-[var(--color-danger)] hover:opacity-90 text-white font-semibold text-xs transition cursor-pointer">
                Permanently Erase My Account
            </button>
        </form>
    </div>

</div>
@endsection

