@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 py-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[var(--border-default)]">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Super Admin Compliance Operations</span>
            <h1 class="text-2xl sm:text-3xl font-bold font-serif text-[var(--text-primary)]">
                Cookie &amp; Regulatory Compliance Console
            </h1>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] mt-1">
                Configure GDPR, ePrivacy, and DPDP consent banner copy, tracking categories, and official policy links.
            </p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn-secondary !min-h-[40px] !text-xs self-start sm:self-center">
            &larr; Admin Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-xs font-semibold text-[var(--color-success)] flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.compliance.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- 1. Banner Copy -->
        <div class="card-ledger p-6 space-y-4">
            <h3 class="font-serif font-bold text-base text-[var(--text-primary)] border-b border-[var(--border-subtle)] pb-2">
                1. Consent Banner Presentation
            </h3>
            
            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Banner Heading</label>
                <input type="text" name="banner_heading" value="{{ old('banner_heading', $settings['banner_heading']) }}" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)] font-medium focus:outline-none focus:border-[var(--accent-primary)]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Banner Plain Copy (Max 2 lines)</label>
                <textarea name="banner_text" rows="3" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)] font-medium focus:outline-none focus:border-[var(--accent-primary)]">{{ old('banner_text', $settings['banner_text']) }}</textarea>
                <span class="text-[11px] text-[var(--text-muted)]">Standard: "We use a few cookies to keep you signed in and understand how the site is used. You choose what we can use."</span>
            </div>
        </div>

        <!-- 2. Policy URLs -->
        <div class="card-ledger p-6 space-y-4">
            <h3 class="font-serif font-bold text-base text-[var(--text-primary)] border-b border-[var(--border-subtle)] pb-2">
                2. Mandatory Policy Links
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Cookie Policy URL</label>
                    <input type="text" name="policy_url" value="{{ old('policy_url', $settings['policy_url']) }}" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)] font-mono focus:outline-none focus:border-[var(--accent-primary)]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Privacy Policy URL</label>
                    <input type="text" name="privacy_url" value="{{ old('privacy_url', $settings['privacy_url']) }}" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)] font-mono focus:outline-none focus:border-[var(--accent-primary)]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Terms of Service URL</label>
                    <input type="text" name="terms_url" value="{{ old('terms_url', $settings['terms_url']) }}" required class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)] font-mono focus:outline-none focus:border-[var(--accent-primary)]">
                </div>
            </div>
        </div>

        <!-- 3. Categories -->
        <div class="card-ledger p-6 space-y-4">
            <h3 class="font-serif font-bold text-base text-[var(--text-primary)] border-b border-[var(--border-subtle)] pb-2">
                3. Cookie Category Descriptions
            </h3>

            @foreach($settings['categories'] as $key => $cat)
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wide">{{ $key }} Category</span>
                        @if($cat['locked'])
                            <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded bg-[var(--color-success-bg)] text-[var(--color-success)]">Locked On</span>
                        @else
                            <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded bg-amber-50 text-amber-800">User Opt-in Only</span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-[var(--text-secondary)] mb-1">Title</label>
                        <input type="text" name="categories[{{ $key }}][title]" value="{{ $cat['title'] }}" class="w-full px-3 py-1.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-[var(--text-secondary)] mb-1">Description</label>
                        <input type="text" name="categories[{{ $key }}][description]" value="{{ $cat['description'] }}" class="w-full px-3 py-1.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)]">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <button type="submit" class="btn-primary !text-xs font-semibold">
                Save Compliance Configurations
            </button>
        </div>
    </form>

</div>
@endsection

