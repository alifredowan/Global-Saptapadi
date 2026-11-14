@extends('layouts.app')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <!-- Header Card -->
    <div class="heirloom-folio p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] rounded-[var(--radius-md)]">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-[var(--border-subtle)]">
            <div class="space-y-1">
                <h1 class="font-serif font-bold text-2xl sm:text-3xl text-[var(--text-primary)]">
                    Explore Verified Candidates
                </h1>
                <p class="text-xs text-[var(--text-secondary)] max-w-2xl">
                    Discover opposite-gender candidate profiles with Vedic lineage integrity, photo privacy protection, and family guardian involvement.
                </p>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('shortlists.index') }}" class="btn-secondary text-xs flex items-center gap-1.5 !min-h-[36px]">
                    <svg class="w-3.5 h-3.5 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
                    <span>Saved Shortlists</span>
                </a>
            </div>
        </div>

        <!-- Filter Bar -->
        <form method="GET" action="{{ route('discovery.index') }}" class="pt-4 space-y-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3 text-xs">
                <!-- Country -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Country / Region</label>
                    <select name="country" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Worldwide Diaspora</option>
                        <option value="United Kingdom" {{ ($filters['country'] ?? '') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                        <option value="United States" {{ ($filters['country'] ?? '') == 'United States' ? 'selected' : '' }}>United States</option>
                        <option value="Canada" {{ ($filters['country'] ?? '') == 'Canada' ? 'selected' : '' }}>Canada</option>
                        <option value="United Arab Emirates" {{ ($filters['country'] ?? '') == 'United Arab Emirates' ? 'selected' : '' }}>UAE</option>
                        <option value="Singapore" {{ ($filters['country'] ?? '') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                        <option value="Australia" {{ ($filters['country'] ?? '') == 'Australia' ? 'selected' : '' }}>Australia</option>
                        <option value="India" {{ ($filters['country'] ?? '') == 'India' ? 'selected' : '' }}>India</option>
                        <option value="Bangladesh" {{ ($filters['country'] ?? '') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                        <option value="Nepal" {{ ($filters['country'] ?? '') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                    </select>
                </div>
                <!-- Min Age -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Min Age</label>
                    <input type="number" name="min_age" value="{{ $filters['min_age'] ?? '' }}" placeholder="21" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>
                <!-- Max Age -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Max Age</label>
                    <input type="number" name="max_age" value="{{ $filters['max_age'] ?? '' }}" placeholder="35" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>
                <!-- City -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">City</label>
                    <input type="text" name="city" value="{{ $filters['city'] ?? '' }}" placeholder="e.g. London, Toronto, Dubai" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>
                <!-- Marital Status -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Marital Status</label>
                    <select name="marital_status" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Any Status</option>
                        <option value="never_married" {{ ($filters['marital_status'] ?? '') == 'never_married' ? 'selected' : '' }}>Never Married</option>
                        <option value="divorced" {{ ($filters['marital_status'] ?? '') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="widowed" {{ ($filters['marital_status'] ?? '') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>
                <!-- Diet -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Diet</label>
                    <select name="diet" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Any Diet</option>
                        <option value="vegetarian" {{ ($filters['diet'] ?? '') == 'vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                        <option value="eggetarian" {{ ($filters['diet'] ?? '') == 'eggetarian' ? 'selected' : '' }}>Eggetarian</option>
                        <option value="non_vegetarian" {{ ($filters['diet'] ?? '') == 'non_vegetarian' ? 'selected' : '' }}>Non-Vegetarian</option>
                        <option value="jain" {{ ($filters['diet'] ?? '') == 'jain' ? 'selected' : '' }}>Jain</option>
                        <option value="vegan" {{ ($filters['diet'] ?? '') == 'vegan' ? 'selected' : '' }}>Vegan</option>
                    </select>
                </div>
                <!-- Mother Tongue -->
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Language</label>
                    <select name="mother_tongue" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Any Language</option>
                        <option value="English" {{ ($filters['mother_tongue'] ?? '') == 'English' ? 'selected' : '' }}>English</option>
                        <option value="Hindi" {{ ($filters['mother_tongue'] ?? '') == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                        <option value="Bengali" {{ ($filters['mother_tongue'] ?? '') == 'Bengali' ? 'selected' : '' }}>Bengali</option>
                        <option value="Gujarati" {{ ($filters['mother_tongue'] ?? '') == 'Gujarati' ? 'selected' : '' }}>Gujarati</option>
                        <option value="Tamil" {{ ($filters['mother_tongue'] ?? '') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                        <option value="Telugu" {{ ($filters['mother_tongue'] ?? '') == 'Telugu' ? 'selected' : '' }}>Telugu</option>
                        <option value="Marathi" {{ ($filters['mother_tongue'] ?? '') == 'Marathi' ? 'selected' : '' }}>Marathi</option>
                        <option value="Punjabi" {{ ($filters['mother_tongue'] ?? '') == 'Punjabi' ? 'selected' : '' }}>Punjabi</option>
                    </select>
                </div>
            </div>

            <!-- Extended Filters (Tradition & Gotra) -->
            <div class="pt-3 border-t border-[var(--border-subtle)] space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[var(--secondary-text)]">
                        Lineage &amp; Cultural Filters
                    </span>
                    @if(!$isPro)
                    <a href="{{ route('membership.index') }}" class="text-[11px] font-medium text-[var(--accent-primary)] hover:underline">Single Vivah Pass features &rarr;</a>
                    @endif
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                    <div>
                        <label class="block font-semibold text-[var(--text-secondary)] mb-1 text-[11px]">Sampradaya</label>
                        <select name="sampradaya" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                            <option value="">Any tradition</option>
                            <option value="Vaishnav" {{ ($filters['sampradaya'] ?? '') == 'Vaishnav' ? 'selected' : '' }}>Vaishnav</option>
                            <option value="Shaiva" {{ ($filters['sampradaya'] ?? '') == 'Shaiva' ? 'selected' : '' }}>Shaiva</option>
                            <option value="Shakta" {{ ($filters['sampradaya'] ?? '') == 'Shakta' ? 'selected' : '' }}>Shakta</option>
                            <option value="Smarta" {{ ($filters['sampradaya'] ?? '') == 'Smarta' ? 'selected' : '' }}>Smarta</option>
                            <option value="ISKCON" {{ ($filters['sampradaya'] ?? '') == 'ISKCON' ? 'selected' : '' }}>ISKCON</option>
                            <option value="Arya Samaj" {{ ($filters['sampradaya'] ?? '') == 'Arya Samaj' ? 'selected' : '' }}>Arya Samaj</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-[var(--text-secondary)] mb-1 text-[11px]">Caste / Community</label>
                        <input type="text" name="caste_jati" value="{{ $filters['caste_jati'] ?? '' }}" placeholder="e.g. Brahmin, Baidya" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                    </div>

                    <div>
                        <label class="block font-semibold text-[var(--text-secondary)] mb-1 text-[11px]">Manglik Status</label>
                        <select name="manglik_status" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                            <option value="">Any</option>
                            <option value="non_manglik" {{ ($filters['manglik_status'] ?? '') == 'non_manglik' ? 'selected' : '' }}>Non-Manglik</option>
                            <option value="manglik" {{ ($filters['manglik_status'] ?? '') == 'manglik' ? 'selected' : '' }}>Manglik</option>
                            <option value="anshik_manglik" {{ ($filters['manglik_status'] ?? '') == 'anshik_manglik' ? 'selected' : '' }}>Anshik Manglik</option>
                        </select>
                    </div>

                    <div class="flex items-center pt-5">
                        <label class="flex items-center gap-2 cursor-pointer text-[var(--text-secondary)]">
                            <input type="checkbox" name="exclude_same_gotra" value="1" {{ !empty($filters['exclude_same_gotra']) ? 'checked' : '' }} class="rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="font-medium text-xs text-[var(--text-primary)]">Exclude my Gotra (Sagotra)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('discovery.index') }}" class="text-xs text-[var(--text-muted)] hover:text-[var(--accent-primary)] underline">Clear filters</a>
                <button type="submit" class="btn-primary text-xs flex items-center gap-1.5 !min-h-[38px]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    <span>Update Search</span>
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
            <article class="heirloom-folio flex flex-col justify-between overflow-hidden bg-[var(--bg-surface)] rounded-[var(--radius-md)] group">
                <div>
                    <!-- Photo Header & Modesty Note -->
                    <div class="relative h-60 bg-[var(--bg-subtle)] overflow-hidden">
                        <img src="{{ $photoUrl }}" alt="{{ $candidate->name }}" class="w-full h-full object-cover transition duration-300 {{ !$canViewPhoto ? 'filter blur-[3px] scale-105' : '' }}">

                        <!-- Top Floating Badges -->
                        <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between gap-2 pointer-events-none">
                            @if($candidate->is_verified)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--bg-surface)]/95 border border-[var(--border-default)] text-[10px] font-semibold text-[var(--color-success)] shadow-xs">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                <span>Verified</span>
                            </span>
                            @else
                            <span></span>
                            @endif

                            <span class="inline-flex items-center px-2 py-0.5 rounded-[var(--radius-xs)] bg-[var(--bg-surface)]/95 border border-[var(--border-default)] text-[10px] font-semibold text-[var(--text-primary)] shadow-xs">
                                {{ $comp['percentage'] }}% Match
                            </span>
                        </div>

                        <!-- Modesty Photo Shield Indicator -->
                        @if(!$canViewPhoto)
                        <div class="silk-veil absolute inset-0 flex flex-col items-center justify-center p-3 text-center text-[var(--color-ink-darker)]">
                            <svg class="w-5 h-5 text-[var(--color-accent)] mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                            <span class="text-[11px] font-serif font-bold text-[var(--color-primary)]">Photo Privacy</span>
                            <span class="text-[9px] text-[var(--text-secondary)] mt-0.5 leading-snug">Shared upon mutual interest</span>
                        </div>
                        @endif

                        <!-- Bottom Headline Scrim -->
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-[#171312]/90 via-[#171312]/40 to-transparent p-3 text-white">
                            <h3 class="font-serif font-bold text-base leading-tight truncate text-white">{{ $candidate->name }}</h3>
                            <p class="text-[11px] text-amber-100 mt-0.5 truncate">
                                {{ $candidate->age }} yrs &bull; {{ $profile?->city ?? 'Diaspora' }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-3.5 space-y-2.5">
                        <!-- Same Gotra Advisory Notice -->
                        @if(!empty($comp['gotra_advisory']['has_advisory']))
                        <div class="p-2 rounded-[var(--radius-xs)] bg-[var(--color-warning-bg)] border border-[var(--color-warning-border)] text-[var(--color-warning)] text-[10px] flex items-start gap-1.5">
                            <svg class="w-3.5 h-3.5 shrink-0 mt-0.5 text-[var(--color-warning)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                            <span class="truncate">{{ $comp['gotra_advisory']['message'] }}</span>
                        </div>
                        @endif

                        <!-- Biodata Ledger Matrix -->
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <span class="text-[9px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Gotra</span>
                                <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->gotra ?? 'Shandilya' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Tradition</span>
                                <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->sampradaya ?? 'Vaishnav' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Profession</span>
                                <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->profession ?? 'Professional' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] uppercase font-bold text-[var(--text-muted)] tracking-wider block">Diet</span>
                                <span class="font-semibold text-[var(--text-primary)] capitalize truncate block">{{ $profile?->diet ?? 'Vegetarian' }}</span>
                            </div>
                        </div>

                        <!-- Astrological Milan Score Compact Row -->
                        @if($comp['guna_milan'])
                        <div class="p-2 rounded-[var(--radius-xs)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-[11px] flex items-center justify-between">
                            <span class="text-[var(--text-secondary)] font-medium">Ashtakoota Milan:</span>
                            <span class="font-bold text-[var(--accent-primary)] font-serif">
                                {{ $comp['guna_milan']['total_score'] }} / 36 Gunas
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Card Footer Actions -->
                <div class="p-3.5 pt-0 border-t border-[var(--border-subtle)] space-y-2 mt-auto">
                    <div class="flex items-center gap-2 pt-2.5">
                        <a href="{{ route('profile.show', $candidate->id) }}" class="btn-secondary flex-1 text-xs text-center justify-center !min-h-[34px]">
                            View Biodata
                        </a>

                        <a href="{{ route('horoscope.compare', $candidate->id) }}" class="btn-secondary text-xs !min-h-[34px] !px-2.5" title="Astrological Milan Breakdown">
                            Milan
                        </a>

                        <!-- Shortlist Toggle Button -->
                        <form method="POST" action="{{ route('shortlist.toggle', $candidate->id) }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-secondary !min-h-[34px] !px-2.5 {{ $item['is_shortlisted'] ? 'text-[var(--secondary-primary)] border-[var(--secondary-border)] bg-[var(--secondary-subtle)]' : 'text-[var(--text-muted)]' }}" title="{{ $item['is_shortlisted'] ? 'Shortlisted' : 'Add to private shortlist' }}">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="{{ $item['is_shortlisted'] ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/></svg>
                            </button>
                        </form>
                    </div>

                    <form method="POST" action="{{ route('proposals.store', $candidate->id) }}" class="w-full">
                        @csrf
                        <button type="submit" class="btn-primary w-full text-xs flex items-center justify-center gap-1.5 cursor-pointer !min-h-[34px]">
                            <span>Express Interest</span>
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="col-span-full card-ledger p-12 text-center bg-[var(--bg-surface)]">
                <div class="w-12 h-12 mx-auto mb-3 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] text-[var(--secondary-primary)] flex items-center justify-center border border-[var(--border-default)]">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <h3 class="font-serif font-bold text-lg text-[var(--text-primary)]">No Profiles Matching Selected Filters</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-1.5 max-w-md mx-auto leading-relaxed">
                    Try broadening your search criteria (for example, expanding the age range or checking "Worldwide") to view more candidate biodatas.
                </p>
                <a href="{{ route('discovery.index') }}" class="mt-4 inline-flex btn-primary text-xs">
                    Reset Filters
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
