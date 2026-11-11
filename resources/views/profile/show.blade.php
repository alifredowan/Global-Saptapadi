@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 pb-20 sm:pb-6">

    <!-- Top Profile Banner & Hero Dossier -->
    <div class="card-ledger overflow-hidden bg-[var(--bg-surface)] border border-[var(--border-default)]">
        <!-- Banner header with delicate Alpona corner ornament -->
        <div class="h-36 bg-[var(--accent-subtle)] border-b border-[var(--accent-border)] relative">
            <div class="absolute top-0 right-0 p-3 pointer-events-none opacity-40">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" class="text-[var(--secondary-primary)]">
                    <path d="M80 0C60 0 20 20 20 80" stroke="currentColor" stroke-width="1.5"/>
                    <circle cx="70" cy="10" r="2" fill="currentColor"/>
                    <circle cx="50" cy="30" r="2" fill="currentColor"/>
                </svg>
            </div>

            @if($isOwnProfile)
            <a href="{{ route('profile.edit') }}" class="absolute top-4 right-4 btn-secondary text-xs flex items-center gap-1.5 !min-h-[34px] !px-3 shadow-xs">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                <span>Edit Biodata</span>
            </a>
            @endif
        </div>

        <div class="px-6 sm:px-8 pb-6 pt-0 relative">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between -mt-16 gap-4 mb-4">
                <!-- Avatar & Candidate Header -->
                <div class="flex items-end gap-4">
                    <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-[var(--radius-sm)] border-4 border-[var(--bg-surface)] shadow-sm bg-[var(--bg-subtle)] overflow-hidden relative shrink-0">
                        <img src="{{ $canViewPhotos ? $user->primary_photo_url : $user->blurred_photo_url }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full object-cover {{ !$canViewPhotos ? 'filter blur-[4px] scale-105' : '' }}">
                        
                        @if(!$canViewPhotos)
                        <div class="absolute inset-0 bg-[#171312]/50 flex flex-col items-center justify-center text-white text-center p-2">
                            <svg class="w-4 h-4 mb-1 text-amber-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <span class="text-[9px] font-semibold tracking-wider text-amber-100">Photo Private</span>
                        </div>
                        @endif
                    </div>

                    <div class="pb-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-[var(--text-primary)]">{{ $user->name }}</h1>
                            @if($user->is_verified)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-[11px] font-semibold text-[var(--color-success)]" title="Government ID Verified">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Verified Candidate</span>
                            </span>
                            @endif
                        </div>
                        <p class="text-xs sm:text-sm text-[var(--text-secondary)] mt-1">
                            {{ $user->age }} Years &bull; {{ $profile?->city ?? 'Location Open' }}, {{ $profile?->country ?? 'Diaspora' }} &bull; Profile managed by {{ ucfirst($user->profile_managed_by) }}
                        </p>
                    </div>
                </div>

                <!-- Desktop Interaction CTA (if viewing someone else) -->
                @if(!$isOwnProfile)
                <div class="hidden sm:flex items-center gap-2 pb-1">
                    <a href="{{ route('horoscope.compare', $user->id) }}" class="btn-secondary text-xs flex items-center gap-1.5 !min-h-[38px]">
                        <svg class="w-4 h-4 text-[var(--secondary-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                        <span>Kundli Milan</span>
                    </a>

                    @if(auth()->user()->hasMutualInterestWith($user->id))
                    <a href="{{ route('chat.show', $user->id) }}" class="btn-primary text-xs flex items-center gap-1.5 !min-h-[38px]">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>Open Chat</span>
                    </a>
                    @else
                    <form method="POST" action="{{ route('proposals.store', $user->id) }}">
                        @csrf
                        <button type="submit" class="btn-primary text-xs flex items-center gap-1.5 !min-h-[38px] cursor-pointer">
                            <span>Send Expression of Interest</span>
                            &rarr;
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>

            <!-- Profile Completeness & Family Review Banner -->
            <div class="p-3 bg-[var(--bg-subtle)] border border-[var(--border-subtle)] rounded-[var(--radius-sm)] flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider">Biodata Completeness:</span>
                    <span class="font-bold text-[var(--accent-primary)]">{{ $profile?->profile_completeness_pct ?? 60 }}%</span>
                </div>
                <div class="w-full sm:w-56 bg-[var(--border-default)] rounded-full h-1.5 overflow-hidden">
                    <div class="bg-[var(--accent-primary)] h-full rounded-full" style="width: {{ $profile?->profile_completeness_pct ?? 60 }}%"></div>
                </div>
                <div class="text-[11px] text-[var(--text-muted)]">
                    Phone numbers and private contact stay shielded until mutual family acceptance.
                </div>
            </div>
        </div>
    </div>

    <!-- Main Biodata Grid (2 Columns on Desktop) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left 2 Columns: Detailed Ledger Specifications -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Narrative About Me -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-3">
                <div class="border-b border-[var(--border-subtle)] pb-2 flex items-center justify-between">
                    <h2 class="text-xs font-semibold text-[var(--secondary-text)] uppercase tracking-wider">
                        Personal Narrative
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed italic p-4 bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] border border-[var(--border-subtle)]">
                    "{{ $profile?->about_me ?? 'A peaceful soul seeking a lifelong partner rooted in mutual respect, devotion, and cultural harmony.' }}"
                </p>
                @if($profile?->partner_preferences_bio)
                <div class="pt-2">
                    <span class="text-xs font-semibold text-[var(--text-primary)] block mb-1">Partner Preferences:</span>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        {{ $profile->partner_preferences_bio }}
                    </p>
                </div>
                @endif
            </div>

            <!-- Lineage & Spiritual Practice -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-semibold text-[var(--secondary-text)] uppercase tracking-wider">
                        Lineage, Sampradaya &amp; Spiritual Lifestyle
                    </h2>
                </div>

                <div class="divide-y divide-[var(--border-subtle)] text-xs">
                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Religion &amp; Sampradaya</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">{{ $profile?->religion ?? 'Hindu' }} ({{ $profile?->sampradaya ?? 'General Dharmic' }})</span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Community / Caste</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">
                            @if($profile?->mask_caste && !$isOwnProfile)
                                <span class="text-[var(--text-muted)] italic">Masked ("Caste No Bar")</span>
                            @else
                                {{ $profile?->caste_jati ?? 'Hindu' }} @if($profile?->sub_caste) &bull; {{ $profile->sub_caste }} @endif
                            @endif
                        </span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Paternal Gotra</span>
                        <span class="font-semibold text-[var(--accent-primary)] text-right w-2/3 font-serif text-sm">
                            @if($profile?->mask_gotra && !$isOwnProfile)
                                <span class="text-[var(--text-muted)] italic text-xs font-sans">Masked until mutual interest</span>
                            @else
                                {{ $profile?->gotra ?? 'Not Stated' }}
                            @endif
                        </span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Maternal Gotra (Nanihal)</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">{{ $profile?->nanihal_gotra ?? 'Not Stated' }}</span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Dietary Practice</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3 capitalize">{{ $profile?->diet ?? 'Vegetarian' }}</span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Puja &amp; Temple Visits</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">{{ ucfirst($profile?->puja_frequency ?? 'Daily') }} Puja &bull; {{ ucfirst($profile?->temple_visits ?? 'Weekly') }} visits</span>
                    </div>
                </div>
            </div>

            <!-- Education & Profession -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-semibold text-[var(--secondary-text)] uppercase tracking-wider">
                        Education &amp; Career
                    </h2>
                </div>

                <div class="divide-y divide-[var(--border-subtle)] text-xs">
                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Qualification</span>
                        <span class="font-semibold text-[var(--text-primary)] text-right w-2/3">{{ $profile?->qualification_level ?? 'Graduate' }}</span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Profession</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">{{ $profile?->profession ?? 'Professional' }} @if($profile?->organization_type) &bull; {{ $profile->organization_type }} @endif</span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Annual Income</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">
                            @if($profile?->mask_income && !$isOwnProfile)
                                <span class="text-[var(--text-muted)] italic">Shared upon mutual interest</span>
                            @else
                                {{ $profile?->annual_income_range ?? 'Available upon family request' }}
                            @endif
                        </span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Citizenship &amp; Ancestry</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">{{ $profile?->citizenship ?? 'Global' }} &bull; {{ $profile?->native_ancestry ?? 'Heritage Open' }}</span>
                    </div>
                </div>
            </div>

            <!-- Family Background -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-semibold text-[var(--secondary-text)] uppercase tracking-wider">
                        Family Roots &amp; Heritage
                    </h2>
                </div>

                <div class="divide-y divide-[var(--border-subtle)] text-xs">
                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Family Structure &amp; Outlook</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">{{ ucfirst($profile?->family_structure ?? 'Nuclear') }} Family &bull; {{ ucfirst($profile?->family_values ?? 'Traditional') }} Values</span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Parents</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">Father: {{ $profile?->father_occupation ?? 'Respected' }} &bull; Mother: {{ $profile?->mother_occupation ?? 'Homemaker' }}</span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Siblings</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">{{ $profile?->brothers_count ?? 0 }} Brother(s) &bull; {{ $profile?->sisters_count ?? 0 }} Sister(s)</span>
                    </div>

                    <div class="py-2.5 flex justify-between gap-4">
                        <span class="text-[var(--text-muted)] w-1/3">Residence Post-Marriage</span>
                        <span class="font-medium text-[var(--text-primary)] text-right w-2/3">{{ ucfirst(str_replace('_', ' ', $profile?->living_arrangements_preference ?? 'Open to discussion')) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Horoscope & Photo Gallery -->
        <div class="space-y-6">

            <!-- Astrological Kundli Dossier -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-semibold text-[var(--secondary-text)] uppercase tracking-wider">
                        Horoscope (Janam Patrika)
                    </h2>
                    @if($kundli?->horoscope_opt_out)
                    <span class="text-[10px] text-[var(--text-muted)]">Optional</span>
                    @endif
                </div>

                @if(!$kundli || $kundli->horoscope_opt_out)
                    <div class="p-4 bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] text-center text-xs text-[var(--text-muted)] border border-[var(--border-subtle)]">
                        Horoscope matching was marked as optional by candidate. Evaluation is based on cultural background, education, and values.
                    </div>
                @else
                    <div class="divide-y divide-[var(--border-subtle)] text-xs">
                        <div class="py-2 flex justify-between">
                            <span class="text-[var(--text-muted)]">Rashi</span>
                            <span class="font-semibold text-[var(--accent-primary)] font-serif text-sm">{{ $kundli->rashi ?? 'Not Specified' }}</span>
                        </div>
                        <div class="py-2 flex justify-between">
                            <span class="text-[var(--text-muted)]">Nakshatra</span>
                            <span class="font-semibold text-[var(--accent-primary)] font-serif text-sm">{{ $kundli->nakshatra ?? 'Not Specified' }} (Charan {{ $kundli->charan ?? 1 }})</span>
                        </div>
                        <div class="py-2 flex justify-between">
                            <span class="text-[var(--text-muted)]">Manglik</span>
                            <span class="font-medium {{ $kundli->manglik_status === 'manglik' ? 'text-[var(--secondary-text)]' : 'text-[var(--color-success)]' }}">
                                {{ ucfirst(str_replace('_', ' ', $kundli->manglik_status ?? 'Non Manglik')) }}
                            </span>
                        </div>
                    </div>

                    @if(!$isOwnProfile)
                    <a href="{{ route('horoscope.compare', $user->id) }}" class="btn-secondary w-full text-xs text-center justify-center !min-h-[38px] mt-2">
                        <span>Compare 36-Point Guna Milan</span>
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    @endif
                @endif
            </div>

            <!-- Photo Gallery (Up to 6 Photos) -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-semibold text-[var(--secondary-text)] uppercase tracking-wider">
                        Photographs ({{ $user->photos->count() }})
                    </h2>
                    <span class="text-[10px] text-[var(--text-muted)]">
                        {{ $canViewPhotos ? 'Unlocked' : 'Protected' }}
                    </span>
                </div>

                @if($user->photos->isEmpty())
                <div class="p-6 bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] text-center text-xs text-[var(--text-muted)] border border-[var(--border-subtle)]">
                    No additional photographs uploaded yet.
                </div>
                @else
                <div class="grid grid-cols-2 gap-2">
                    @foreach($user->photos as $p)
                    <div class="relative h-28 rounded-[var(--radius-sm)] overflow-hidden bg-[var(--bg-subtle)] border border-[var(--border-default)]">
                        <img src="{{ $canViewPhotos ? asset($p->photo_path) : asset($p->blurred_photo_path ?? $p->photo_path) }}" 
                             alt="Candidate photo" 
                             class="w-full h-full object-cover {{ !$canViewPhotos ? 'filter blur-[3px] scale-105' : '' }}">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Mobile-First Sticky Bottom Action Bar (48px touch target) -->
    @if(!$isOwnProfile)
    <div class="sm:hidden fixed bottom-0 inset-x-0 bg-[var(--bg-surface)] border-t border-[var(--border-default)] p-3 z-30 shadow-lg flex items-center justify-between gap-3">
        <a href="{{ route('horoscope.compare', $user->id) }}" class="btn-secondary flex-1 text-center justify-center !min-h-[48px] !h-[48px] !text-xs font-semibold">
            Kundli Milan
        </a>

        @if(auth()->user()->hasMutualInterestWith($user->id))
        <a href="{{ route('chat.show', $user->id) }}" class="btn-primary flex-1 text-center justify-center !min-h-[48px] !h-[48px] !text-xs font-semibold">
            Open Chat
        </a>
        @else
        <form method="POST" action="{{ route('proposals.store', $user->id) }}" class="flex-1">
            @csrf
            <button type="submit" class="btn-primary w-full text-center justify-center !min-h-[48px] !h-[48px] !text-xs font-semibold cursor-pointer">
                Send Interest
            </button>
        </form>
        @endif
    </div>
    @endif

</div>
@endsection
