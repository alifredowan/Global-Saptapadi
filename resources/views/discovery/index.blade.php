@extends('layouts.app')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <!-- Header with dignified heading -->
    <div class="card-ledger pattern-header p-6 sm:p-8 bg-[var(--accent-primary)] text-white">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-[var(--radius-sm)] bg-white/10 border border-white/20 text-white text-xs font-semibold uppercase tracking-wider mb-3">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/></svg>
                <span>Dharmic Matchmaking Discovery</span>
            </div>
            <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white">
                Finding Your Destined Dharmic Life Partner
            </h1>
            <p class="text-xs sm:text-sm text-white/80 mt-2 leading-relaxed">
                Opposite-gender discovery calibrated with 36-Point Ashtakoota Guna Milan, Gotra lineage protection, family values, and statutory safety shields.
            </p>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="card-ledger p-6 bg-[var(--bg-surface)]">
        <form method="GET" action="{{ route('discovery.index') }}" class="space-y-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3 text-xs">
                <!-- Country / Global Diaspora -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Country / Diaspora</label>
                    <select name="country" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Worldwide (Global)</option>
                        <option value="United States" {{ ($filters['country'] ?? '') == 'United States' ? 'selected' : '' }}>United States</option>
                        <option value="United Kingdom" {{ ($filters['country'] ?? '') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                        <option value="Canada" {{ ($filters['country'] ?? '') == 'Canada' ? 'selected' : '' }}>Canada</option>
                        <option value="Australia" {{ ($filters['country'] ?? '') == 'Australia' ? 'selected' : '' }}>Australia</option>
                        <option value="India" {{ ($filters['country'] ?? '') == 'India' ? 'selected' : '' }}>India</option>
                        <option value="Singapore" {{ ($filters['country'] ?? '') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                        <option value="United Arab Emirates" {{ ($filters['country'] ?? '') == 'United Arab Emirates' ? 'selected' : '' }}>UAE</option>
                    </select>
                </div>
                <!-- Min Age -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Min Age</label>
                    <input type="number" name="min_age" value="{{ $filters['min_age'] ?? '' }}" placeholder="21" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>
                <!-- Max Age -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Max Age</label>
                    <input type="number" name="max_age" value="{{ $filters['max_age'] ?? '' }}" placeholder="35" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>
                <!-- City -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">City / Region</label>
                    <input type="text" name="city" value="{{ $filters['city'] ?? '' }}" placeholder="e.g. New York, London" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>
                <!-- Marital Status -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Marital Status</label>
                    <select name="marital_status" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Any Status</option>
                        <option value="never_married" {{ ($filters['marital_status'] ?? '') == 'never_married' ? 'selected' : '' }}>Never Married</option>
                        <option value="divorced" {{ ($filters['marital_status'] ?? '') == 'divorced' ? 'selected' : '' }}>Divorced (Remarriage)</option>
                        <option value="widowed" {{ ($filters['marital_status'] ?? '') == 'widowed' ? 'selected' : '' }}>Widowed (Remarriage)</option>
                    </select>
                </div>
                <!-- Diet -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Dietary Practice</label>
                    <select name="diet" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Any Diet</option>
                        <option value="vegetarian" {{ ($filters['diet'] ?? '') == 'vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                        <option value="eggetarian" {{ ($filters['diet'] ?? '') == 'eggetarian' ? 'selected' : '' }}>Eggetarian</option>
                        <option value="non_vegetarian" {{ ($filters['diet'] ?? '') == 'non_vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
                        <option value="jain" {{ ($filters['diet'] ?? '') == 'jain' ? 'selected' : '' }}>Jain (No Root Veg)</option>
                        <option value="vegan" {{ ($filters['diet'] ?? '') == 'vegan' ? 'selected' : '' }}>Vegan</option>
                    </select>
                </div>
                <!-- Mother Tongue -->
                <div>
                    <label class="block font-bold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Mother Tongue</label>
                    <select name="mother_tongue" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Any</option>
                        <option value="Bengali" {{ ($filters['mother_tongue'] ?? '') == 'Bengali' ? 'selected' : '' }}>Bengali</option>
                        <option value="Hindi" {{ ($filters['mother_tongue'] ?? '') == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                        <option value="English" {{ ($filters['mother_tongue'] ?? '') == 'English' ? 'selected' : '' }}>English</option>
                    </select>
                </div>
            </div>

            <!-- Advanced Pro Filters Accordion -->
            <div class="pt-3 border-t border-[var(--border-subtle)]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--secondary-text)] flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-[var(--secondary-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <span>Advanced Cultural &amp; Horoscope Filters (Pro Single Vivah Pass)</span>
                    </span>
                    @if(!$isPro)
                    <a href="{{ route('membership.index') }}" class="text-[11px] font-bold text-[var(--accent-primary)] hover:underline">Unlock All Pro Filters &rarr;</a>
                    @endif
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                    <!-- Sampradaya -->
                    <div>
                        <label class="block font-semibold text-[var(--text-secondary)] mb-1 text-[11px]">Sampradaya (Tradition)</label>
                        <select name="sampradaya" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                            <option value="">Any Sampradaya</option>
                            <option value="Vaishnav" {{ ($filters['sampradaya'] ?? '') == 'Vaishnav' ? 'selected' : '' }}>Vaishnav</option>
                            <option value="Shaiva" {{ ($filters['sampradaya'] ?? '') == 'Shaiva' ? 'selected' : '' }}>Shaiva</option>
                            <option value="Shakta" {{ ($filters['sampradaya'] ?? '') == 'Shakta' ? 'selected' : '' }}>Shakta</option>
                            <option value="Smarta" {{ ($filters['sampradaya'] ?? '') == 'Smarta' ? 'selected' : '' }}>Smarta</option>
                            <option value="ISKCON" {{ ($filters['sampradaya'] ?? '') == 'ISKCON' ? 'selected' : '' }}>ISKCON</option>
                            <option value="Arya Samaj" {{ ($filters['sampradaya'] ?? '') == 'Arya Samaj' ? 'selected' : '' }}>Arya Samaj</option>
                        </select>
                    </div>

                    <!-- Caste / Jati -->
                    <div>
                        <label class="block font-semibold text-[var(--text-secondary)] mb-1 text-[11px]">Caste / Community</label>
                        <input type="text" name="caste_jati" value="{{ $filters['caste_jati'] ?? '' }}" placeholder="e.g. Brahmin, Baidya" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                    </div>

                    <!-- Manglik Status -->
                    <div>
                        <label class="block font-semibold text-[var(--text-secondary)] mb-1 text-[11px]">Manglik Status</label>
                        <select name="manglik_status" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                            <option value="">Any Astrological Placement</option>
                            <option value="non_manglik" {{ ($filters['manglik_status'] ?? '') == 'non_manglik' ? 'selected' : '' }}>Non-Manglik</option>
                            <option value="manglik" {{ ($filters['manglik_status'] ?? '') == 'manglik' ? 'selected' : '' }}>Manglik</option>
                            <option value="anshik_manglik" {{ ($filters['manglik_status'] ?? '') == 'anshik_manglik' ? 'selected' : '' }}>Anshik Manglik</option>
                        </select>
                    </div>

                    <!-- Gotra Exclusion Checkbox -->
                    <div class="flex items-center pt-5">
                        <label class="flex items-center gap-2 cursor-pointer text-[var(--text-secondary)]">
                            <input type="checkbox" name="exclude_same_gotra" value="1" {{ !empty($filters['exclude_same_gotra']) ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="font-semibold text-xs text-[var(--text-primary)]">Exclude My Gotra</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('discovery.index') }}" class="text-xs text-[var(--text-muted)] hover:text-[var(--accent-primary)] font-semibold underline">Reset Filters</a>
                <button type="submit" class="btn-primary text-xs flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <span>Search Compatible Matches</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Candidate Results Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($results as $item)
            @php
                $candidate = $item['user'];
                $profile = $candidate->profile;
                $kundli = $candidate->kundli;
                $comp = $item['compatibility'];
                $canViewPhoto = $item['can_view_photos'];
                $photoUrl = $canViewPhoto ? $candidate->primary_photo_url : $candidate->blurred_photo_url;
            @endphp
            <article class="card-ledger flex flex-col justify-between overflow-hidden group">
                <div>
                    <!-- Photo Header & Badges Container -->
                    <div class="relative h-60 bg-[var(--neutral-900)] overflow-hidden">
                        <img src="{{ $photoUrl }}" alt="{{ $candidate->name }}" class="w-full h-full object-cover group-hover:scale-102 transition duration-300 {{ !$canViewPhoto ? 'filter blur-sm scale-110' : '' }}">

                        <!-- Top Floating Badges -->
                        <div class="absolute top-3 inset-x-3 flex items-center justify-between gap-2 pointer-events-none">
                            @if($candidate->is_verified)
                            <span class="badge-verified bg-black/75 text-white border-white/20 backdrop-blur-xs">
                                <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                <span>Verified</span>
                            </span>
                            @else
                            <span></span>
                            @endif

                            <span class="badge-status bg-black/70 text-white border-white/20 backdrop-blur-xs">
                                {{ $comp['percentage'] }}% Match
                            </span>
                        </div>

                        <!-- Modesty Photo Shield Indicator -->
                        @if(!$canViewPhoto)
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none bg-black/40">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[var(--radius-sm)] bg-black/75 border border-white/15 text-white text-[11px] font-semibold backdrop-blur-xs">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                <span>Photo Privacy Active</span>
                            </span>
                        </div>
                        @endif

                        <!-- Bottom Headline Scrim -->
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent p-4 text-white">
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="text-base font-bold leading-tight truncate">{{ $candidate->name }}</h3>
                                <span class="text-[10px] px-2 py-0.5 rounded-[var(--radius-xs)] bg-white/20 text-white font-semibold">
                                    {{ ucfirst(str_replace('_', ' ', $candidate->marital_status)) }}
                                </span>
                            </div>
                            <p class="text-xs text-[var(--neutral-300)] mt-0.5 truncate">
                                {{ $candidate->age }} yrs &bull; {{ $profile?->height_cm ? round($profile->height_cm / 30.48, 1) . ' ft' : 'Height undisclosed' }} &bull; {{ $profile?->city ?? 'Location flexible' }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-4 space-y-3">
                        <!-- Same Gotra Advisory Notice -->
                        @if(!empty($comp['gotra_advisory']['has_advisory']))
                        <div class="p-2.5 rounded-[var(--radius-sm)] bg-[var(--color-warning-bg)] border border-[var(--color-warning-border)] text-[var(--color-warning)] text-[11px] flex items-start gap-1.5">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            <div class="min-w-0 flex-1">
                                <span class="font-bold text-[10px] block leading-tight">{{ $comp['gotra_advisory']['title'] }}</span>
                                <span class="text-[9px] leading-tight block mt-0.5 truncate" title="{{ $comp['gotra_advisory']['message'] }}">{{ $comp['gotra_advisory']['message'] }}</span>
                            </div>
                        </div>
                        @endif

                        <!-- Biodata Ledger Matrix -->
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Caste &amp; Gotra</span>
                                <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->caste_jati ?? 'Hindu' }} ({{ $profile?->gotra ?? 'Gotra N/A' }})</span>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Sampradaya</span>
                                <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->sampradaya ?? 'Dharmic' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Profession</span>
                                <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->profession ?? 'Professional' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Diet</span>
                                <span class="font-semibold text-[var(--text-primary)] capitalize truncate block">{{ $profile?->diet ?? 'Vegetarian' }}</span>
                            </div>
                        </div>

                        <!-- Astrological Milan Score Compact Row -->
                        @if($comp['guna_milan'])
                        <div class="p-2.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-[11px]">
                            <div class="flex items-center justify-between font-bold gap-1.5">
                                <span class="text-[var(--text-secondary)] flex items-center gap-1 shrink-0 text-xs">
                                    <svg class="w-3.5 h-3.5 text-[var(--secondary-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                                    <span>Ashtakoota Milan:</span>
                                </span>
                                <span class="px-2 py-0.5 rounded-[var(--radius-xs)] {{ $comp['guna_milan']['total_score'] >= 18 ? 'bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]' : 'bg-[var(--color-danger-bg)] text-[var(--color-danger)] border border-[var(--color-danger-border)]' }} text-[10px] font-bold shrink-0">
                                    {{ $comp['guna_milan']['total_score'] }} / 36
                                </span>
                            </div>
                            <div class="mt-1 text-[10px] text-[var(--text-muted)] flex items-center justify-between gap-1 border-t border-[var(--border-subtle)] pt-1">
                                <span class="shrink-0">Rating:</span>
                                <span class="font-bold text-[var(--text-primary)] text-right truncate">{{ $comp['guna_milan']['classification'] }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Card Footer Actions -->
                <div class="p-4 pt-0 border-t border-[var(--border-subtle)] space-y-2 mt-auto">
                    <div class="flex items-center gap-2 pt-3">
                        <a href="{{ route('profile.show', $candidate->id) }}" class="btn-secondary flex-1 text-xs text-center justify-center">
                            View Biodata
                        </a>

                        <a href="{{ route('horoscope.compare', $candidate->id) }}" class="btn-outline text-xs whitespace-nowrap" title="Astrological Milan Breakdown">
                            Milan
                        </a>

                        <!-- Shortlist Toggle Button -->
                        <form method="POST" action="{{ route('shortlist.toggle', $candidate->id) }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-outline text-xs p-2 {{ $item['is_shortlisted'] ? 'bg-[var(--secondary-subtle)] text-[var(--secondary-primary)] border-[var(--secondary-border)]' : '' }}" title="{{ $item['is_shortlisted'] ? 'Shortlisted' : 'Add to private shortlist' }}">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="{{ $item['is_shortlisted'] ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </button>
                        </form>
                    </div>

                    <!-- Proposal Form Trigger: Full Width Primary Button -->
                    <form method="POST" action="{{ route('proposals.store', $candidate->id) }}" class="w-full">
                        @csrf
                        <button type="submit" class="btn-primary w-full text-xs flex items-center justify-center gap-1.5 cursor-pointer">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                            <span>Send Interest</span>
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="col-span-full card-ledger p-12 text-center bg-[var(--bg-surface)]">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-[var(--bg-subtle)] text-[var(--text-muted)] flex items-center justify-center border border-[var(--border-default)]">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <h3 class="font-serif font-bold text-lg text-[var(--text-primary)]">No Candidates Found Matching Selected Criteria</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1.5 max-w-md mx-auto">
                    Try broadening your filters (e.g. extending age range or enabling "Caste no bar") to discover more Dharmic seekers.
                </p>
                <a href="{{ route('discovery.index') }}" class="mt-4 inline-flex btn-primary text-xs">
                    Reset All Filters
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $candidates->links() }}
    </div>
</div>
@endsection
