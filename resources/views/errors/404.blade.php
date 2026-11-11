@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center space-y-6">
        
        <!-- Warm Alpona / Path Motif -->
        <div class="w-20 h-20 mx-auto rounded-full bg-[var(--color-haldi-soft)] border border-[var(--color-haldi)]/40 flex items-center justify-center text-[var(--color-primary)] dark:text-[var(--color-accent)]">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
            </svg>
        </div>

        <div class="space-y-2">
            <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--color-accent)]">
                404 &bull; Page Not Found
            </span>
            <h1 class="font-serif font-bold text-3xl text-stone-900 dark:text-stone-100 tracking-tight">
                This path has gently wandered
            </h1>
            <p class="text-xs sm:text-sm text-stone-600 dark:text-stone-400 leading-relaxed max-w-sm mx-auto">
                The page or profile you were looking for is not here. It may have been updated, or the link has changed.
            </p>
        </div>

        <!-- Alpona line divider -->
        <div class="flex items-center justify-center gap-2 text-[var(--color-accent)]/40">
            <span class="w-8 h-px bg-current"></span>
            <span class="text-xs">&diams;</span>
            <span class="w-8 h-px bg-current"></span>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
            <a href="{{ url('/') }}" class="px-5 py-2.5 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white text-xs font-medium transition shadow-xs">
                Return to Home
            </a>
            <a href="{{ route('discovery.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-300 dark:border-stone-700 text-stone-700 dark:text-stone-300 hover:bg-stone-50 dark:hover:bg-stone-800 text-xs font-medium transition">
                Discover Candidates
            </a>
        </div>
    </div>
</div>
@endsection

