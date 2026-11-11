@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 py-6">

    <!-- Header Banner -->
    <div class="section--dark rounded-[var(--radius-lg)] p-8 sm:p-12 relative overflow-hidden shadow-sm">
        <div class="relative z-10 space-y-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-xs font-semibold tracking-wider text-amber-200 uppercase">
                Ethical Matrimonial Covenant
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold font-serif text-white">
                Terms of Matrimony &amp; Conduct
            </h1>
            <p class="text-sm sm:text-base text-[#F3E4DD] max-w-2xl leading-relaxed">
                Clear rules safeguarding dignity, zero dowry tolerance, and respectful family interactions.
            </p>
        </div>
    </div>

    <!-- 4 Essential Rules -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="card-ledger p-6 space-y-3">
            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] text-[var(--color-danger)] flex items-center justify-center font-bold text-sm">
                01
            </div>
            <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Strict Zero-Dowry Policy</h3>
            <p class="text-sm text-[var(--text-secondary)]">Demanding or negotiating dowry in any guise results in immediate lifetime ban and legal reporting.</p>
        </div>

        <div class="card-ledger p-6 space-y-3">
            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center font-bold text-sm">
                02
            </div>
            <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Genuine Marriage Intent</h3>
            <p class="text-sm text-[var(--text-secondary)]">This platform is strictly for matrimonial covenants. Dating, casual encounters, and commercial solicitation are prohibited.</p>
        </div>

        <div class="card-ledger p-6 space-y-3">
            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] text-[var(--secondary-text)] flex items-center justify-center font-bold text-sm">
                03
            </div>
            <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Verified Statutory Age</h3>
            <p class="text-sm text-[var(--text-secondary)]">All members must satisfy statutory marriage age (21+ for grooms, 18+ for brides) validated by government ID.</p>
        </div>

        <div class="card-ledger p-6 space-y-3">
            <div class="w-10 h-10 rounded-[var(--radius-sm)] bg-[var(--color-success-bg)] text-[var(--color-success)] flex items-center justify-center font-bold text-sm">
                04
            </div>
            <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Single Vivah Pass Guarantee</h3>
            <p class="text-sm text-[var(--text-secondary)]">One single $29 USD fee until your sacred marriage ceremony. Zero monthly auto-renewals or artificial locks.</p>
        </div>

    </div>

</div>
@endsection

