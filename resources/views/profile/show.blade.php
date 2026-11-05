@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Profile Banner -->
    <div class="card-ledger overflow-hidden bg-[var(--bg-surface)]">
        <div class="h-40 bg-[var(--accent-primary)] pattern-header relative">
            @if($isOwnProfile)
            <a href="{{ route('profile.edit') }}" class="absolute top-4 right-4 btn-secondary text-xs shadow-xs flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                <span>Edit My Biodata</span>
            </a>
            @endif
        </div>

        <div class="px-6 sm:px-8 pb-8 pt-0 relative">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between -mt-16 gap-4 mb-6">
                <!-- Avatar & Status -->
                <div class="flex items-end gap-4">
                    <div class="w-32 h-32 rounded-[var(--radius-md)] border-4 border-[var(--bg-surface)] shadow-md bg-[var(--neutral-100)] overflow-hidden relative shrink-0">
                        <img src="{{ $canViewPhotos ? $user->primary_photo_url : $user->blurred_photo_url }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full object-cover {{ !$canViewPhotos ? 'filter blur-sm scale-110' : '' }}">
                        
                        @if(!$canViewPhotos)
                        <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-white text-center p-2">
                            <svg class="w-5 h-5 mb-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <span class="text-[9px] font-bold uppercase tracking-wider">Modesty Blurred</span>
                        </div>
                        @endif
                    </div>

                    <div class="pb-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-[var(--text-primary)]">{{ $user->name }}</h1>
                            @if($user->is_verified)
                            <span class="badge-verified" title="Government ID & Live Selfie KYC Verified">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Verified Seeker</span>
                            </span>
                            @endif
                        </div>
                        <p class="text-xs sm:text-sm text-[var(--text-secondary)] font-medium mt-1">
                            {{ $user->age }} Years &bull; {{ $profile?->city ?? 'Location Open' }}, {{ $profile?->country ?? 'Global Diaspora' }} &bull; Managed by {{ ucfirst($user->profile_managed_by) }}
                        </p>
                    </div>
                </div>

                <!-- Interaction CTA (if viewing someone else) -->
                @if(!$isOwnProfile)
                <div class="flex items-center gap-2 pb-1">
                    <a href="{{ route('horoscope.compare', $user->id) }}" class="btn-secondary text-xs flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-[var(--secondary-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                        <span>Ashtakoota Guna Milan</span>
                    </a>

                    @if(auth()->user()->hasMutualInterestWith($user->id))
                    <a href="{{ route('chat.show', $user->id) }}" class="btn-primary text-xs flex items-center gap-1.5">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>Open Chaperoned Chat</span>
                    </a>
                    @else
                    <form method="POST" action="{{ route('proposals.store', $user->id) }}">
                        @csrf
                        <button type="submit" class="btn-primary text-xs flex items-center gap-1.5">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                            <span>Transmit Formal Interest</span>
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>

            <!-- Completeness Bar -->
            <div class="p-3.5 bg-[var(--bg-subtle)] border border-[var(--border-subtle)] rounded-[var(--radius-sm)] flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2">
                    <span class="font-bold text-[var(--text-primary)] uppercase tracking-wider text-[11px]">Biodata Completeness:</span>
                    <span class="font-bold text-[var(--accent-primary)]">{{ $profile?->profile_completeness_pct ?? 60 }}%</span>
                </div>
                <div class="w-full sm:w-64 bg-[var(--border-default)] rounded-full h-2 overflow-hidden">
                    <div class="bg-[var(--accent-primary)] h-full rounded-full transition-all duration-300" style="width: {{ $profile?->profile_completeness_pct ?? 60 }}%"></div>
                </div>
                <div class="text-[11px] text-[var(--text-muted)]">
                    High-trust verified biodatas receive 4.5x higher matching discovery.
                </div>
            </div>
        </div>
    </div>

    <!-- Main Biodata Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left 2 Columns: Detailed Specifications -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Narrative About Me -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-3">
                <div class="border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>Candidate Narrative &amp; Personal Reflections</span>
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed italic p-4 bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] border border-[var(--border-subtle)]">
                    "{{ $profile?->about_me ?? 'A peaceful Dharmic soul seeking a lifelong companion built upon mutual respect, devotion, and cultural harmony.' }}"
                </p>
            </div>

            <!-- Cultural, Spiritual & Heritage Classification (FR-2.3, FR-2.4, FR-2.6) -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>Lineage, Community &amp; Spiritual Practice</span>
                    </h2>
                </div>

                <dl class="divide-y divide-[var(--border-subtle)]">
                    <div class="def-row">
                        <dt class="def-term">Religion &amp; Sampradaya</dt>
                        <dd class="def-desc">{{ $profile?->religion ?? 'Hindu' }} ({{ $profile?->sampradaya ?? 'General Dharmic' }})</dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Community &amp; Sub-Caste</dt>
                        <dd class="def-desc">
                            @if($profile?->mask_caste && !$isOwnProfile)
                                <span class="text-[var(--text-muted)] italic">Masked by candidate ("Caste No Bar")</span>
                            @else
                                {{ $profile?->caste_jati ?? 'Hindu' }} @if($profile?->sub_caste) &bull; {{ $profile->sub_caste }} @endif
                            @endif
                        </dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Paternal Gotra</dt>
                        <dd class="def-desc">
                            @if($profile?->mask_gotra && !$isOwnProfile)
                                <span class="text-[var(--text-muted)] italic">Masked until mutual interest</span>
                            @else
                                {{ $profile?->gotra ?? 'Not Stated' }}
                            @endif
                        </dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Maternal Lineage (Nanihal Gotra)</dt>
                        <dd class="def-desc">{{ $profile?->nanihal_gotra ?? 'Not Stated' }}</dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Daily Puja &amp; Temple Visits</dt>
                        <dd class="def-desc">{{ ucfirst($profile?->puja_frequency ?? 'Daily') }} Puja &bull; {{ ucfirst($profile?->temple_visits ?? 'Weekly') }} visits</dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Fasting (Vrata) &amp; Scripture</dt>
                        <dd class="def-desc">{{ ucfirst($profile?->fasting_vrata ?? 'Festivals') }} &bull; {{ ucfirst($profile?->scripture_study ?? 'Occasional') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Education & Professional Background (FR-2.2) -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>Education &amp; Professional Dossier</span>
                    </h2>
                </div>

                <dl class="divide-y divide-[var(--border-subtle)]">
                    <div class="def-row">
                        <dt class="def-term">Highest Qualification</dt>
                        <dd class="def-desc">
                            <span class="font-semibold text-[var(--text-primary)]">{{ $profile?->qualification_level ?? 'Graduate' }}</span>
                            @if($profile?->education_detail)
                            <span class="text-[var(--text-muted)] block text-xs mt-0.5">{{ $profile->education_detail }}</span>
                            @endif
                        </dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Profession &amp; Enterprise</dt>
                        <dd class="def-desc">
                            <span class="font-semibold text-[var(--text-primary)]">{{ $profile?->profession ?? 'Professional' }}</span>
                            @if($profile?->organization_type)
                            <span class="text-[var(--text-muted)] block text-xs mt-0.5">{{ $profile->organization_type }}</span>
                            @endif
                        </dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Annual Gross Income Range</dt>
                        <dd class="def-desc">
                            @if($profile?->mask_income && !$isOwnProfile)
                                <span class="text-[var(--text-muted)] italic">Disclosed to mutual matches only</span>
                            @else
                                {{ $profile?->annual_income_range ?? 'Available upon request' }}
                            @endif
                        </dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Citizenship &amp; Native Ancestry</dt>
                        <dd class="def-desc">{{ $profile?->citizenship ?? 'Global Citizen' }} &bull; {{ $profile?->native_ancestry ?? 'Ancestral Heritage' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Family Heritage & Background (FR-2.7) -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>Family Values &amp; Living Arrangements</span>
                    </h2>
                </div>

                <dl class="divide-y divide-[var(--border-subtle)]">
                    <div class="def-row">
                        <dt class="def-term">Family Structure &amp; Values</dt>
                        <dd class="def-desc">{{ ucfirst($profile?->family_structure ?? 'Nuclear') }} Family &bull; {{ ucfirst($profile?->family_values ?? 'Traditional') }} Values</dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Parents' Occupations</dt>
                        <dd class="def-desc">Father: {{ $profile?->father_occupation ?? 'Respected' }} &bull; Mother: {{ $profile?->mother_occupation ?? 'Homemaker' }}</dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Siblings</dt>
                        <dd class="def-desc">{{ $profile?->brothers_count ?? 0 }} Brother(s) &bull; {{ $profile?->sisters_count ?? 0 }} Sister(s)</dd>
                    </div>

                    <div class="def-row">
                        <dt class="def-term">Post-Marriage Living Preference</dt>
                        <dd class="def-desc">{{ ucfirst(str_replace('_', ' ', $profile?->living_arrangements_preference ?? 'Flexible')) }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Right Column: Horoscope & Photo Gallery -->
        <div class="space-y-6">

            <!-- Astrological Natal Profile (FR-3.1, FR-3.4) -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>Janam Patrika / Kundli</span>
                    </h2>
                    @if($kundli?->horoscope_opt_out)
                    <span class="badge-status text-[10px]">Opted Out</span>
                    @endif
                </div>

                @if(!$kundli || $kundli->horoscope_opt_out)
                    <div class="p-4 bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] text-center text-xs text-[var(--text-muted)] border border-[var(--border-subtle)]">
                        "Horoscope Not Required" selected by candidate. Matching evaluates lifestyle, cultural traditions, and family values.
                    </div>
                @else
                    <dl class="divide-y divide-[var(--border-subtle)] text-xs">
                        <div class="def-row">
                            <dt class="def-term">Rashi (Moon Sign)</dt>
                            <dd class="def-desc font-semibold text-[var(--accent-primary)]">{{ $kundli->rashi ?? 'Not Specified' }}</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Nakshatra</dt>
                            <dd class="def-desc font-semibold text-[var(--accent-primary)]">{{ $kundli->nakshatra ?? 'Not Specified' }} (Charan {{ $kundli->charan ?? 1 }})</dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Manglik Status</dt>
                            <dd class="def-desc font-semibold {{ $kundli->manglik_status === 'manglik' ? 'text-[var(--color-warning)]' : 'text-[var(--color-success)]' }}">
                                {{ ucfirst(str_replace('_', ' ', $kundli->manglik_status ?? 'Non Manglik')) }}
                            </dd>
                        </div>
                        <div class="def-row">
                            <dt class="def-term">Chart Verification</dt>
                            <dd class="def-desc font-semibold {{ $kundli->chart_verified_by_pandit ? 'text-[var(--color-success)]' : 'text-[var(--text-muted)]' }}">
                                {{ $kundli->chart_verified_by_pandit ? 'Verified by Pandit' : 'Self-declared chart' }}
                            </dd>
                        </div>
                    </dl>

                    @if(!$isOwnProfile)
                    <a href="{{ route('horoscope.compare', $user->id) }}" class="btn-secondary w-full text-xs text-center justify-center">
                        <span>Compare 36-Point Guna Milan</span>
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                    @endif
                @endif
            </div>

            <!-- Photo Gallery (Up to 6 Photos with Privacy Controls) -->
            <div class="card-ledger p-6 bg-[var(--bg-surface)] space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2">
                    <h2 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>Photo Gallery ({{ $user->photos->count() }}/6)</span>
                    </h2>
                    <span class="text-[10px] text-[var(--text-muted)] font-semibold uppercase">
                        {{ ucfirst(str_replace('_', ' ', $profile?->photo_privacy ?? 'blur_until_mutual')) }}
                    </span>
                </div>

                @if($user->photos->isEmpty())
                <div class="p-6 bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] text-center text-xs text-[var(--text-muted)] border border-[var(--border-subtle)]">
                    No additional gallery photographs uploaded yet.
                </div>
                @else
                <div class="grid grid-cols-2 gap-2">
                    @foreach($user->photos as $p)
                    <div class="relative h-28 rounded-[var(--radius-sm)] overflow-hidden bg-[var(--neutral-100)] border border-[var(--border-subtle)]">
                        <img src="{{ $canViewPhotos ? asset($p->photo_path) : asset($p->blurred_photo_path ?? $p->photo_path) }}" 
                             alt="Photo" 
                             class="w-full h-full object-cover {{ !$canViewPhotos ? 'filter blur-sm scale-110' : '' }}">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
