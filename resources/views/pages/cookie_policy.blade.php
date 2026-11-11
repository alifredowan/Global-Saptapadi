@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 py-6">

    <!-- Header Banner -->
    <div class="section--dark rounded-[var(--radius-lg)] p-8 sm:p-12 relative overflow-hidden shadow-sm">
        <div class="relative z-10 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold tracking-wider text-amber-200 uppercase">
                GDPR &bull; ePrivacy &bull; DPDP Compliance
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold font-serif text-white">
                Cookie Policy &amp; Tracking Consent
            </h1>
            <p class="text-sm sm:text-base text-[#F3E4DD] max-w-2xl leading-relaxed">
                We use a few cookies to keep you signed in and understand how the site is used. You choose what we can use.
            </p>
        </div>
    </div>

    <!-- Scannable Categories -->
    <div class="space-y-4">
        
        <!-- Essential -->
        <div class="card-ledger p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1 max-w-xl">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[var(--color-success)]"></span>
                    <h3 class="text-base font-bold text-[var(--text-primary)]">1. Strictly Essential Cookies</h3>
                    <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-[var(--color-success-bg)] text-[var(--color-success)]">Always Active</span>
                </div>
                <p class="text-xs text-[var(--text-secondary)]">Required for session authentication, CSRF tokens, and interface accessibility. These cannot be disabled.</p>
            </div>
            <span class="text-xs font-semibold text-[var(--text-muted)] self-start md:self-center">Locked On</span>
        </div>

        <!-- Analytics -->
        <div class="card-ledger p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1 max-w-xl">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[var(--secondary-primary)]"></span>
                    <h3 class="text-base font-bold text-[var(--text-primary)]">2. Anonymous Analytics</h3>
                    <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-[var(--bg-subtle)] text-[var(--text-secondary)]">Optional</span>
                </div>
                <p class="text-xs text-[var(--text-secondary)]">Aggregated page views and discovery funnel performance to improve family matchmaking. Blocked until explicit consent.</p>
            </div>
            <button type="button" @click="window.dispatchEvent(new CustomEvent('open-cookie-settings'))" class="btn-secondary !text-xs self-start md:self-center">
                Configure
            </button>
        </div>

        <!-- Marketing -->
        <div class="card-ledger p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1 max-w-xl">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-stone-400"></span>
                    <h3 class="text-base font-bold text-[var(--text-primary)]">3. Marketing &amp; Outreach</h3>
                    <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-[var(--bg-subtle)] text-[var(--text-secondary)]">Optional</span>
                </div>
                <p class="text-xs text-[var(--text-secondary)]">Helps reach global Hindu families. No third-party data brokers or behavioral retargeting. Blocked until opt-in.</p>
            </div>
            <button type="button" @click="window.dispatchEvent(new CustomEvent('open-cookie-settings'))" class="btn-secondary !text-xs self-start md:self-center">
                Configure
            </button>
        </div>

    </div>

    <!-- Reopen Modal Trigger Box -->
    <div class="card-ledger p-6 bg-[var(--accent-subtle)] border-[var(--accent-border)] flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h4 class="font-bold text-[var(--accent-text)]">Revoke or Change Consent</h4>
            <p class="text-xs text-[var(--text-secondary)] mt-0.5">Under ePrivacy and DPDP, you may modify or withdraw cookie consent anytime with one click.</p>
        </div>
        <button type="button" @click="window.dispatchEvent(new CustomEvent('open-cookie-settings'))" class="btn-primary !text-xs">
            Open Cookie Settings
        </button>
    </div>

</div>
@endsection

