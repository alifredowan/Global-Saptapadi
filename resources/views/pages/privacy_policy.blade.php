@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 py-6">

    <!-- Header Banner -->
    <div class="section--dark rounded-[var(--radius-lg)] p-8 sm:p-12 relative overflow-hidden shadow-sm">
        <div class="relative z-10 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold tracking-wider text-amber-200 uppercase">
                Privacy Rights &amp; Data Ethics
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold font-serif text-white">
                Your family's privacy, strictly guarded.
            </h1>
            <p class="text-sm sm:text-base text-[#F3E4DD] max-w-2xl leading-relaxed">
                We never sell member data, host ads, or expose phone numbers without mutual family consent.
            </p>
        </div>
    </div>

    <!-- Scannable Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="card-ledger p-6 space-y-3">
            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
            </div>
            <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Contact Shields</h3>
            <p class="text-sm text-[var(--text-secondary)]">Phone numbers stay masked until both families review and accept interest.</p>
        </div>

        <div class="card-ledger p-6 space-y-3">
            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] text-[var(--secondary-text)] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
            </div>
            <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Modest Photo Privacy</h3>
            <p class="text-sm text-[var(--text-secondary)]">Photographs can remain respectfully blurred until you grant individual permissions.</p>
        </div>

        <div class="card-ledger p-6 space-y-3">
            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
            </div>
            <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Government ID Verification</h3>
            <p class="text-sm text-[var(--text-secondary)]">IDs are reviewed in AES-256 encrypted vaults and purged post-verification.</p>
        </div>

        <div class="card-ledger p-6 space-y-3">
            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] text-[var(--secondary-text)] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
            </div>
            <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Right to Complete Erasure</h3>
            <p class="text-sm text-[var(--text-secondary)]">Delete your account anytime with instant cascading removal across all servers.</p>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="card-ledger p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h4 class="font-bold text-[var(--text-primary)]">Manage Your Cookie &amp; Privacy Preferences</h4>
            <p class="text-xs text-[var(--text-secondary)] mt-0.5">You can inspect or adjust your tracking and cookie settings at any time.</p>
        </div>
        <button type="button" @click="window.dispatchEvent(new CustomEvent('open-cookie-settings'))" class="btn-secondary !text-xs">
            Open Cookie Settings
        </button>
    </div>

</div>
@endsection

