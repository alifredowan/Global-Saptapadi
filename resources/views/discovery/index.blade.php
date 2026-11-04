@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header with auspicious blessing -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-2xl p-6 sm:p-8 text-amber-100 shadow-md relative overflow-hidden">
        <div class="max-w-3xl">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-3">
                <span>✨</span>
                <span>Dharmic Matchmaking Discovery</span>
            </div>
            <h1 class="font-heading font-bold text-2xl sm:text-3xl text-amber-100">
                Finding Your Destined Dharmic Life Partner
            </h1>
            <p class="text-xs sm:text-sm text-amber-200/80 mt-2 leading-relaxed">
                Opposite-gender discovery calibrated with 36-Point Ashtakoota Guna Milan, Gotra lineage protection, family values, and statutory safety shields.
            </p>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm">
        <form method="GET" action="{{ route('discovery.index') }}" class="space-y-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3 text-xs">
                <!-- Country / Global Diaspora -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Country / Diaspora</label>
                    <select name="country" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
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
                    <label class="block font-bold text-gray-700 uppercase mb-1">Min Age</label>
                    <input type="number" name="min_age" value="{{ $filters['min_age'] ?? '' }}" placeholder="21" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>
                <!-- Max Age -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Max Age</label>
                    <input type="number" name="max_age" value="{{ $filters['max_age'] ?? '' }}" placeholder="35" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>
                <!-- City -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">City / Region</label>
                    <input type="text" name="city" value="{{ $filters['city'] ?? '' }}" placeholder="e.g. New York, London, Toronto" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>
                <!-- Marital Status -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Marital Status</label>
                    <select name="marital_status" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="">Any Status</option>
                        <option value="never_married" {{ ($filters['marital_status'] ?? '') == 'never_married' ? 'selected' : '' }}>Never Married</option>
                        <option value="divorced" {{ ($filters['marital_status'] ?? '') == 'divorced' ? 'selected' : '' }}>Divorced (Remarriage)</option>
                        <option value="widowed" {{ ($filters['marital_status'] ?? '') == 'widowed' ? 'selected' : '' }}>Widowed (Remarriage)</option>
                    </select>
                </div>
                <!-- Diet -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Dietary Practice</label>
                    <select name="diet" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
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
                    <label class="block font-bold text-gray-700 uppercase mb-1">Mother Tongue</label>
                    <select name="mother_tongue" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="">Any</option>
                        <option value="Bengali" {{ ($filters['mother_tongue'] ?? '') == 'Bengali' ? 'selected' : '' }}>Bengali</option>
                        <option value="Hindi" {{ ($filters['mother_tongue'] ?? '') == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                        <option value="English" {{ ($filters['mother_tongue'] ?? '') == 'English' ? 'selected' : '' }}>English</option>
                    </select>
                </div>
            </div>

            <!-- Advanced Pro Filters Accordion -->
            <div class="pt-3 border-t border-gray-100">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-900 flex items-center space-x-1.5">
                        <span>⭐</span>
                        <span>Advanced Cultural & Horoscope Filters (Pro Single Vivah Pass)</span>
                    </span>
                    @if(!$isPro)
                    <a href="{{ route('membership.index') }}" class="text-[11px] font-bold text-amber-700 hover:underline">Unlock All Pro Filters →</a>
                    @endif
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                    <!-- Sampradaya -->
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Sampradaya (Tradition)</label>
                        <select name="sampradaya" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
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
                        <label class="block font-semibold text-gray-600 mb-1">Caste / Community</label>
                        <input type="text" name="caste_jati" value="{{ $filters['caste_jati'] ?? '' }}" placeholder="e.g. Brahmin, Kayastha, Baidya" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                    </div>

                    <!-- Manglik Status -->
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Manglik Status</label>
                        <select name="manglik_status" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                            <option value="">Any Astrological Placement</option>
                            <option value="non_manglik" {{ ($filters['manglik_status'] ?? '') == 'non_manglik' ? 'selected' : '' }}>Non-Manglik</option>
                            <option value="manglik" {{ ($filters['manglik_status'] ?? '') == 'manglik' ? 'selected' : '' }}>Manglik</option>
                            <option value="anshik_manglik" {{ ($filters['manglik_status'] ?? '') == 'anshik_manglik' ? 'selected' : '' }}>Anshik Manglik</option>
                        </select>
                    </div>

                    <!-- Gotra Exclusion Checkbox -->
                    <div class="flex items-center pt-5">
                        <label class="flex items-center space-x-2 cursor-pointer text-gray-700">
                            <input type="checkbox" name="exclude_same_gotra" value="1" {{ !empty($filters['exclude_same_gotra']) ? 'checked' : '' }} class="rounded text-red-900 focus:ring-red-800">
                            <span class="font-semibold text-xs">Exclude My Gotra (Same-Gotra Avoidance)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('discovery.index') }}" class="text-xs text-gray-500 hover:text-red-900 font-semibold underline">Reset Filters</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl gold-gradient text-white font-bold text-xs shadow-sm hover:opacity-95 transition flex items-center space-x-1.5">
                    <span>🔍</span>
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
            <div class="bg-white rounded-2xl border border-amber-200/80 shadow-xs hover:border-amber-400/80 smooth-card overflow-hidden flex flex-col justify-between transition-all duration-300">
                
                <div>
                    <!-- Photo Header & Badges with Gradient Overlay -->
                    <div class="relative h-52 sm:h-56 bg-stone-900 overflow-hidden group">
                        <img src="{{ $photoUrl }}" alt="{{ $candidate->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 ease-out {{ !$canViewPhoto ? 'filter blur-sm scale-110' : '' }}">

                        <!-- Gradient overlay at bottom of photo -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/25 to-transparent"></div>

                        <!-- Top Floating Badges -->
                        <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between pointer-events-none">
                            @if($candidate->is_verified)
                            <span class="bg-emerald-900/90 backdrop-blur-xs text-emerald-200 px-2 py-0.5 rounded-full border border-emerald-400/40 text-[10px] font-bold shadow-xs">
                                ✓ Verified
                            </span>
                            @else
                            <span></span>
                            @endif

                            <span class="bg-red-950/90 backdrop-blur-xs text-amber-200 px-2.5 py-0.5 rounded-full border border-amber-400/40 text-[10px] font-bold shadow-xs">
                                ✨ {{ $comp['percentage'] }}% Match
                            </span>
                        </div>

                        <!-- Modesty Photo Shield Notice (if photo blurred) -->
                        @if(!$canViewPhoto)
                        <div class="absolute inset-0 bg-red-950/50 backdrop-blur-xs flex flex-col items-center justify-center text-center p-3 text-white">
                            <span class="text-xl mb-0.5">🔒</span>
                            <span class="font-bold text-[11px] uppercase tracking-wider text-amber-200">Modesty Photo Shield</span>
                            <span class="text-[10px] text-stone-200 mt-0.5">Unlocks upon mutual proposal acceptance</span>
                        </div>
                        @endif

                        <!-- Photo Bottom Overlay: Name, Age, Marital Status -->
                        <div class="absolute bottom-2.5 inset-x-3 text-white">
                            <div class="flex items-center justify-between gap-1.5">
                                <h3 class="font-heading font-bold text-base text-white tracking-wide truncate drop-shadow-sm">
                                    {{ $candidate->name }}
                                </h3>
                                <span class="text-[9px] px-2 py-0.5 rounded-full bg-white/20 backdrop-blur-xs text-amber-100 font-semibold border border-white/20 shrink-0 whitespace-nowrap">
                                    {{ ucfirst(str_replace('_', ' ', $candidate->marital_status)) }}
                                </span>
                            </div>
                            <p class="text-[11px] text-amber-200/90 font-medium truncate mt-0.5 drop-shadow-xs">
                                {{ $candidate->age }} yrs • {{ $profile?->height_cm ? round($profile->height_cm / 30.48, 1) . ' ft' : 'Height undisclosed' }} • {{ $profile?->city ?? 'Location flexible' }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-3.5 space-y-2.5">
                        <!-- Same Gotra Advisory Notice (FR-3.6) -->
                        @if(!empty($comp['gotra_advisory']['has_advisory']))
                        <div class="p-2 rounded-xl bg-amber-50 border border-amber-300 text-amber-950 text-[11px] flex items-start space-x-1.5">
                            <span class="shrink-0 text-xs mt-0.5">⚠️</span>
                            <div class="min-w-0 flex-1">
                                <span class="font-bold text-[10px] block leading-tight">{{ $comp['gotra_advisory']['title'] }}</span>
                                <span class="text-[9px] text-amber-900/80 leading-tight block mt-0.5 truncate" title="{{ $comp['gotra_advisory']['message'] }}">{{ $comp['gotra_advisory']['message'] }}</span>
                            </div>
                        </div>
                        @endif

                        <!-- Cultural & Personal Specs Grid -->
                        <div class="grid grid-cols-2 gap-2 text-[11px] bg-amber-50/50 p-2.5 rounded-xl border border-amber-100/80">
                            <div class="min-w-0">
                                <span class="text-stone-400 block text-[9px] uppercase font-bold tracking-wider">Caste & Gotra</span>
                                <span class="font-semibold text-stone-800 truncate block">{{ $profile?->caste_jati ?? 'Hindu' }} ({{ $profile?->gotra ?? 'Gotra N/A' }})</span>
                            </div>
                            <div class="min-w-0">
                                <span class="text-stone-400 block text-[9px] uppercase font-bold tracking-wider">Sampradaya</span>
                                <span class="font-semibold text-stone-800 truncate block">{{ $profile?->sampradaya ?? 'Dharmic' }}</span>
                            </div>
                            <div class="min-w-0">
                                <span class="text-stone-400 block text-[9px] uppercase font-bold tracking-wider">Profession</span>
                                <span class="font-semibold text-stone-800 truncate block">{{ $profile?->profession ?? 'Professional' }}</span>
                            </div>
                            <div class="min-w-0">
                                <span class="text-stone-400 block text-[9px] uppercase font-bold tracking-wider">Diet</span>
                                <span class="font-semibold text-stone-800 capitalize truncate block">{{ $profile?->diet ?? 'Vegetarian' }}</span>
                            </div>
                        </div>

                        <!-- Astrological Milan Score Compact Row -->
                        @if($comp['guna_milan'])
                        <div class="p-2 rounded-xl bg-red-50/60 border border-red-100/90 text-[11px]">
                            <div class="flex items-center justify-between font-bold gap-1.5">
                                <span class="text-amber-950 flex items-center space-x-1 shrink-0">
                                    <span>🪐</span>
                                    <span>Ashtakoota Milan:</span>
                                </span>
                                <span class="px-2 py-0.5 rounded-full {{ $comp['guna_milan']['total_score'] >= 18 ? 'bg-emerald-100 text-emerald-900 border border-emerald-300' : 'bg-red-100 text-red-900 border border-red-300' }} text-[10px] font-extrabold shrink-0">
                                    {{ $comp['guna_milan']['total_score'] }} / 36
                                </span>
                            </div>
                            <div class="mt-1 text-[10px] text-stone-600 flex items-center justify-between gap-1 border-t border-red-100/60 pt-1">
                                <span class="shrink-0 text-stone-500">Rating:</span>
                                <span class="font-bold text-red-900 text-right truncate">{{ $comp['guna_milan']['classification'] }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Card Footer Actions (2-Row Compact Layout) -->
                <div class="p-3.5 pt-0 border-t border-stone-100 space-y-2 mt-auto">
                    <div class="flex items-center gap-1.5 pt-2">
                        <a href="{{ route('profile.show', $candidate->id) }}" class="flex-1 text-center py-2 px-2.5 rounded-xl border border-amber-300 bg-amber-50/70 hover:bg-amber-100 text-amber-950 font-bold text-xs transition active:scale-[0.98]">
                            View Biodata
                        </a>

                        <a href="{{ route('horoscope.compare', $candidate->id) }}" class="py-2 px-2.5 rounded-xl border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold whitespace-nowrap transition active:scale-[0.98]" title="Astrological Milan Breakdown">
                            🪐 Milan
                        </a>

                        <!-- Shortlist Toggle Button -->
                        <form method="POST" action="{{ route('shortlist.toggle', $candidate->id) }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 px-2.5 rounded-xl border transition active:scale-[0.98] cursor-pointer {{ $item['is_shortlisted'] ? 'bg-amber-100 border-amber-400 text-amber-800' : 'border-gray-200 hover:bg-gray-50 text-gray-400' }}" title="{{ $item['is_shortlisted'] ? 'Shortlisted' : 'Add to private shortlist' }}">
                                {{ $item['is_shortlisted'] ? '★' : '☆' }}
                            </button>
                        </form>
                    </div>

                    <!-- Proposal Form Trigger: Full Width Primary Button -->
                    <form method="POST" action="{{ route('proposals.store', $candidate->id) }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full py-2 px-3 rounded-xl gold-gradient text-white font-bold text-xs shadow-xs hover:opacity-95 transition active:scale-[0.98] flex items-center justify-center space-x-1.5 cursor-pointer">
                            <span>💌</span>
                            <span>Send Interest</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-2xl p-12 text-center border border-amber-200">
                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center text-3xl">
                    🔍
                </div>
                <h3 class="font-heading font-bold text-xl text-gray-800">No Candidates Found Matching Selected Criteria</h3>
                <p class="text-xs text-gray-500 mt-2 max-w-md mx-auto">
                    Try broadening your filters (e.g. extending age range or enabling "Caste no bar") to discover more Dharmic seekers.
                </p>
                <a href="{{ route('discovery.index') }}" class="mt-4 inline-block px-5 py-2 rounded-xl gold-gradient text-white text-xs font-bold">
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

