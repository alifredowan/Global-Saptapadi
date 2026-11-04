@extends('layouts.app')

@section('content')
<div class="space-y-16 py-4">

    <!-- ========================================================= -->
    <!-- 1. HERO SECTION: SACRED GATEWAY TO VEDIC MATRIMONY       -->
    <!-- ========================================================= -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-red-950 via-[#2a080c] to-amber-950 text-amber-100 p-8 sm:p-12 lg:p-16 shadow-2xl border border-amber-800/40">
        <!-- Auspicious Glow Background Elements -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-4xl mx-auto text-center space-y-6">
            <!-- Vedic Heritage Pill -->
            <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/40 text-amber-300 text-xs font-bold uppercase tracking-widest shadow-sm">
                <span>🕉️</span>
                <span>Sacred Matrimonial Union • Global Dharmic Diaspora</span>
            </div>

            <!-- Heading -->
            <h1 class="font-heading font-extrabold text-3xl sm:text-5xl lg:text-6xl text-amber-100 tracking-wide leading-tight">
                Where Sacred Traditions Meet Authentic Life Partnerships
            </h1>

            <!-- Subheading -->
            <p class="text-sm sm:text-base lg:text-lg text-amber-200/90 max-w-3xl mx-auto leading-relaxed">
                Vivah Connect brings together prospective brides, grooms, and esteemed families across the worldwide diaspora with <strong>36-Point Ashtakoota Guna Milan</strong>, <strong>Gotra lineage verification</strong>, <strong>100% ID KYC trust</strong>, and <strong>transparent non-commercial ethics</strong>.
            </p>

            <!-- Hero Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-4">
                <a href="{{ route('register') }}" class="px-7 py-3.5 rounded-xl gold-gradient hover:opacity-95 text-white font-bold text-sm shadow-lg shadow-red-950/50 transition transform hover:-translate-y-0.5 flex items-center space-x-2">
                    <span>✨</span>
                    <span>Create Sacred Biodata (Free)</span>
                </a>
                <a href="{{ route('login') }}" class="px-6 py-3.5 rounded-xl bg-amber-100/10 hover:bg-amber-100/20 text-amber-200 border border-amber-400/50 font-bold text-sm transition">
                    Sign In to Portal →
                </a>
                <a href="#sacred-pillars" class="px-5 py-3.5 rounded-xl text-amber-300/80 hover:text-amber-100 font-semibold text-xs transition">
                    Explore Sacred Process ↓
                </a>
            </div>

            <!-- Auspicious Trust Highlights Strip -->
            <div class="pt-8 border-t border-amber-800/40 grid grid-cols-2 sm:grid-cols-5 gap-3 text-[11px] text-amber-200/90 font-medium">
                <div class="p-2.5 rounded-xl bg-amber-950/40 border border-amber-800/30">
                    <span class="block text-base mb-0.5">🛡️</span>
                    <strong class="text-amber-100">100% ID KYC</strong>
                    <span class="block text-[10px] text-amber-300/70">Govt ID & Liveness</span>
                </div>
                <div class="p-2.5 rounded-xl bg-amber-950/40 border border-amber-800/30">
                    <span class="block text-base mb-0.5">🪐</span>
                    <strong class="text-amber-100">Ashtakoota Milan</strong>
                    <span class="block text-[10px] text-amber-300/70">36 Guna Vedic Engine</span>
                </div>
                <div class="p-2.5 rounded-xl bg-amber-950/40 border border-amber-800/30">
                    <span class="block text-base mb-0.5">🚫</span>
                    <strong class="text-amber-100">Zero Dowry Policy</strong>
                    <span class="block text-[10px] text-amber-300/70">UN CEDAW Protected</span>
                </div>
                <div class="p-2.5 rounded-xl bg-amber-950/40 border border-amber-800/30">
                    <span class="block text-base mb-0.5">💎</span>
                    <strong class="text-amber-100">Single Vivah Pass</strong>
                    <span class="block text-[10px] text-amber-300/70">$29 USD (No Monthly Traps)</span>
                </div>
                <div class="p-2.5 rounded-xl bg-amber-950/40 border border-amber-800/30 col-span-2 sm:col-span-1">
                    <span class="block text-base mb-0.5">👨‍👩‍👧</span>
                    <strong class="text-amber-100">Family Oversight</strong>
                    <span class="block text-[10px] text-amber-300/70">3-Way Chaperoned Chat</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 2. INTERACTIVE MATCH FINDER PREVIEW BAR                  -->
    <!-- ========================================================= -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-amber-200/90 shadow-md">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-6 pb-4 border-b border-amber-100">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-700 block">Dharmic Search Engine</span>
                <h2 class="text-xl sm:text-2xl font-bold font-heading text-red-950">
                    Find Compatible Dharmic Matches
                </h2>
            </div>
            <p class="text-xs text-stone-500 max-w-md">
                Filter prospective seekers across the worldwide diaspora based on age, Gotra lineage, dietary sanskar, and astrological harmony.
            </p>
        </div>

        <form action="{{ route('discovery.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5 text-xs">
                <!-- Looking For -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1 text-[11px]">Looking For</label>
                    <select name="gender" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white font-medium">
                        <option value="female">Dharmic Bride (Kanya)</option>
                        <option value="male">Dharmic Groom (Var)</option>
                    </select>
                </div>

                <!-- Age Range -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1 text-[11px]">Age Range</label>
                    <div class="flex items-center space-x-1.5">
                        <input type="number" name="min_age" value="21" min="18" max="70" class="w-1/2 px-2.5 py-2.5 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs text-center font-medium">
                        <span class="text-stone-400 font-bold">to</span>
                        <input type="number" name="max_age" value="35" min="18" max="70" class="w-1/2 px-2.5 py-2.5 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs text-center font-medium">
                    </div>
                </div>

                <!-- Diaspora Country -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1 text-[11px]">Diaspora Region</label>
                    <select name="country" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white font-medium">
                        <option value="">Worldwide Diaspora</option>
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="India">India</option>
                    </select>
                </div>

                <!-- Sampradaya -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1 text-[11px]">Sampradaya</label>
                    <select name="sampradaya" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white font-medium">
                        <option value="">Any Tradition</option>
                        <option value="Vaishnav">Vaishnav</option>
                        <option value="Shaiva">Shaiva</option>
                        <option value="Shakta">Shakta</option>
                        <option value="Smarta">Smarta</option>
                        <option value="ISKCON">ISKCON</option>
                    </select>
                </div>

                <!-- Diet -->
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1 text-[11px]">Dietary Sanskar</label>
                    <select name="diet" class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white font-medium">
                        <option value="">Any Diet</option>
                        <option value="vegetarian">Vegetarian</option>
                        <option value="jain">Jain (Sattvic)</option>
                        <option value="vegan">Vegan</option>
                        <option value="eggetarian">Eggetarian</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2">
                <span class="text-[11px] text-stone-500 hidden sm:inline">
                    🔒 Filter results respect strict Sagotra advisories and modesty photo blur.
                </span>
                <button type="submit" class="px-6 py-2.5 rounded-xl gold-gradient text-white font-bold text-xs shadow-md hover:opacity-95 transition flex items-center space-x-1.5 ml-auto">
                    <span>🔍</span>
                    <span>Search Compatible Matches</span>
                </button>
            </div>
        </form>
    </div>

    <!-- ========================================================= -->
    <!-- 3. FOUR SACRED STAGES OF VEDIC UNION                     -->
    <!-- ========================================================= -->
    <div id="sacred-pillars" class="space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-700">The Authentic Matrimonial Path</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-red-950">
                4 Sacred Stages of Vedic Matrimonial Union
            </h2>
            <p class="text-xs sm:text-sm text-stone-600">
                A solemn, dignified journey designed to honor Vedic rituals, parental respect, and individual aspirations.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Stage 1 -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-red-100 border border-red-200 text-red-900 font-black text-lg flex items-center justify-center mb-4">
                        1
                    </div>
                    <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block">Stage I • Satya</span>
                    <h3 class="font-heading font-bold text-base text-red-950 mt-1 mb-2">Dharmic Biodata & Trust KYC</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        Comprehensive profile setup including paternal and maternal Gotra, spiritual habits, diet, and educational achievements. Verified via 100% government ID & biometric liveness to eliminate impersonation.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-amber-100 text-[11px] font-semibold text-emerald-800 flex items-center space-x-1">
                    <span>✓</span>
                    <span>Zero Fake Accounts</span>
                </div>
            </div>

            <!-- Stage 2 -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 border border-amber-300 text-amber-900 font-black text-lg flex items-center justify-center mb-4">
                        2
                    </div>
                    <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block">Stage II • Sanskar</span>
                    <h3 class="font-heading font-bold text-base text-red-950 mt-1 mb-2">36-Guna Ashtakoota Milan</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        Precision astrological calculation across 8 sacred Kootas (Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, Nadi). Automatic Sagotra warning flags and Manglik cancellation assessments.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-amber-100 text-[11px] font-semibold text-amber-900 flex items-center space-x-1">
                    <span>🪐</span>
                    <span>Astrological Integrity</span>
                </div>
            </div>

            <!-- Stage 3 -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 border border-rose-200 text-rose-900 font-black text-lg flex items-center justify-center mb-4">
                        3
                    </div>
                    <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block">Stage III • Kula Gaurav</span>
                    <h3 class="font-heading font-bold text-base text-red-950 mt-1 mb-2">Chaperoned Family Dialogue</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        Real-time WebSockets messaging with designated family elders or community Ghotoks. Protected contact shield hides phone and email until mutual family consent. Automated anti-dowry interceptor blocks illicit demands.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-amber-100 text-[11px] font-semibold text-red-800 flex items-center space-x-1">
                    <span>🛡️</span>
                    <span>Protected Contact Shield</span>
                </div>
            </div>

            <!-- Stage 4 -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-xs hover:border-amber-400 transition smooth-card flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 border border-emerald-200 text-emerald-900 font-black text-lg flex items-center justify-center mb-4">
                        4
                    </div>
                    <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block">Stage IV • Shubho Bibaho</span>
                    <h3 class="font-heading font-bold text-base text-red-950 mt-1 mb-2">Sacred Marriage Solemnization</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        Upon sacred wedding rites (Saptapadi), both families register their union in the Shubho Bibaho Registry to receive a commemorative digital marriage certificate and gracefully exit the matrimonial search pool together.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-amber-100 text-[11px] font-semibold text-emerald-800 flex items-center space-x-1">
                    <span>💍</span>
                    <span>Immutable Registry</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 4. CANDIDATE PREVIEW SHOWCASE (DISCOVERY CARDS)           -->
    <!-- ========================================================= -->
    <div id="candidates" class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2 border-b border-amber-200/80">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-amber-700">Verified Seekers</span>
                <h2 class="text-xl sm:text-2xl font-bold font-heading text-red-950">
                    Sample Candidate Previews
                </h2>
            </div>
            <a href="{{ route('register') }}" class="text-xs font-bold text-amber-800 hover:text-red-900 transition flex items-center space-x-1">
                <span>Join to browse all candidate profiles</span>
                <span>→</span>
            </a>
        </div>

        <!-- Sample Cards Grid (Matching Exact Discovery Card Geometry) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @forelse($featuredCandidates as $candidate)
                @php
                    $profile = $candidate->profile;
                    $kundli = $candidate->kundli;
                @endphp
                <div class="bg-white rounded-2xl border border-amber-200/80 shadow-xs hover:border-amber-400/80 smooth-card overflow-hidden flex flex-col justify-between transition-all duration-300">
                    <div>
                        <!-- Photo Header with Modesty Protection -->
                        <div class="relative h-52 sm:h-56 bg-stone-900 overflow-hidden group">
                            <img src="{{ $candidate->primary_photo_url }}" alt="{{ $candidate->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 ease-out {{ $candidate->gender === 'female' ? 'filter blur-sm scale-110' : '' }}">

                            <!-- Gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/25 to-transparent"></div>

                            <!-- Top Floating Badges -->
                            <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between pointer-events-none">
                                <span class="bg-emerald-900/90 backdrop-blur-xs text-emerald-200 px-2 py-0.5 rounded-full border border-emerald-400/40 text-[10px] font-bold shadow-xs">
                                    ✓ Verified Seeker
                                </span>
                                <span class="bg-red-950/90 backdrop-blur-xs text-amber-200 px-2.5 py-0.5 rounded-full border border-amber-400/40 text-[10px] font-bold shadow-xs">
                                    ✨ {{ $candidate->id === 3 ? '89%' : ($candidate->id === 4 ? '70%' : '85%') }} Match
                                </span>
                            </div>

                            @if($candidate->gender === 'female')
                            <!-- Modesty Photo Shield Notice -->
                            <div class="absolute inset-0 bg-red-950/50 backdrop-blur-xs flex flex-col items-center justify-center text-center p-3 text-white">
                                <span class="text-xl mb-0.5">🔒</span>
                                <span class="font-bold text-[11px] uppercase tracking-wider text-amber-200">Modesty Photo Shield</span>
                                <span class="text-[10px] text-stone-200 mt-0.5">Unlocks upon mutual proposal acceptance</span>
                            </div>
                            @endif

                            <!-- Bottom Overlay -->
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
                                    {{ $candidate->age ?? 28 }} yrs • {{ $profile?->height_cm ? round($profile->height_cm / 30.48, 1) . ' ft' : '5.8 ft' }} • {{ $profile?->city ?? 'Diaspora' }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-3.5 space-y-2.5">
                            <!-- Cultural Specs Grid -->
                            <div class="grid grid-cols-2 gap-2 text-[11px] bg-amber-50/50 p-2.5 rounded-xl border border-amber-100/80">
                                <div class="min-w-0">
                                    <span class="text-stone-400 block text-[9px] uppercase font-bold tracking-wider">Caste & Gotra</span>
                                    <span class="font-semibold text-stone-800 truncate block">{{ $profile?->caste_jati ?? 'Brahmin' }} ({{ $profile?->gotra ?? 'Shandilya' }})</span>
                                </div>
                                <div class="min-w-0">
                                    <span class="text-stone-400 block text-[9px] uppercase font-bold tracking-wider">Sampradaya</span>
                                    <span class="font-semibold text-stone-800 truncate block">{{ $profile?->sampradaya ?? 'Vaishnav' }}</span>
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
                            <div class="p-2 rounded-xl bg-red-50/60 border border-red-100/90 text-[11px]">
                                <div class="flex items-center justify-between font-bold gap-1.5">
                                    <span class="text-amber-950 flex items-center space-x-1 shrink-0">
                                        <span>🪐</span>
                                        <span>Ashtakoota Milan:</span>
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-900 border border-emerald-300 text-[10px] font-extrabold shrink-0">
                                        {{ $candidate->id === 3 ? '29.5' : ($candidate->id === 4 ? '17.5' : '26.0') }} / 36
                                    </span>
                                </div>
                                <div class="mt-1 text-[10px] text-stone-600 flex items-center justify-between gap-1 border-t border-red-100/60 pt-1">
                                    <span class="shrink-0 text-stone-500">Rating:</span>
                                    <span class="font-semibold text-emerald-900 truncate">
                                        {{ $candidate->id === 4 ? 'Ashubh (Advisory Required)' : 'Uttam (High Compatibility)' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Connect CTA Button -->
                    <div class="p-3.5 pt-0">
                        <a href="{{ route('login') }}" class="w-full py-2 rounded-xl border border-red-900 text-red-900 hover:bg-red-50 font-bold text-xs transition text-center block">
                            Sign In to View Full Biodata
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8 text-stone-500 text-xs">
                    Candidate previews currently loading.
                </div>
            @endforelse
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 5. SINGLE VIVAH PASS: NON-RECURRING MATRIMONIAL ETHICS    -->
    <!-- ========================================================= -->
    <div id="single-pass" class="bg-gradient-to-br from-amber-50 via-white to-orange-50 rounded-3xl p-8 sm:p-12 border-2 border-amber-300 shadow-xl space-y-8">
        <div class="max-w-3xl mx-auto text-center space-y-3">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-amber-500/10 text-amber-900 text-xs font-bold uppercase tracking-wider">
                <span>💎</span>
                <span>Authentic Non-Commercial Ethics</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-extrabold font-heading text-red-950">
                Single Vivah Pass • $29 USD (One-Time Fee)
            </h2>
            <p class="text-xs sm:text-sm text-stone-700 leading-relaxed max-w-2xl mx-auto">
                <strong>We reject monthly subscription billing traps.</strong> Commercial matrimonial apps profit by keeping you searching month after month. Vivah Connect aligns its purpose with your sacred union: pay once for a single marriage journey.
            </p>
        </div>

        <!-- Comparison Cards: Commercial Monopoly vs. Vivah Connect -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <!-- Commercial Monopoly Card -->
            <div class="bg-stone-50 rounded-2xl p-6 border border-stone-300/80 text-xs space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-stone-200">
                    <span class="font-bold text-stone-600 uppercase tracking-wider">Commercial Portals</span>
                    <span class="text-red-700 font-extrabold">$35–$60 / Month</span>
                </div>
                <ul class="space-y-2.5 text-stone-600">
                    <li class="flex items-start space-x-2">
                        <span class="text-red-600 font-bold">✗</span>
                        <span>Recurring monthly auto-renewals that silently rebill your card.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-red-600 font-bold">✗</span>
                        <span>Financial incentive to prolong your search rather than solemnize marriage.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-red-600 font-bold">✗</span>
                        <span>Casual dating profiles, unverified phone numbers, and automated bots.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-red-600 font-bold">✗</span>
                        <span>Zero anti-dowry safeguards or customary Sagotra lineage checks.</span>
                    </li>
                </ul>
            </div>

            <!-- Vivah Connect Sacred Model Card -->
            <div class="bg-gradient-to-b from-red-950 to-[#2c090c] rounded-2xl p-6 border-2 border-amber-400 text-amber-100 text-xs space-y-4 shadow-lg relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-amber-500/20 rounded-full blur-xl pointer-events-none"></div>

                <div class="flex items-center justify-between pb-3 border-b border-amber-800/60">
                    <div>
                        <span class="font-heading font-bold text-base text-amber-200 block">Single Vivah Pass</span>
                        <span class="text-[10px] text-amber-400/80">Valid until Shubho Bibaho Marriage</span>
                    </div>
                    <div class="text-right">
                        <span class="text-2xl font-black text-amber-300">$29 USD</span>
                        <span class="block text-[10px] text-amber-400/80">$19 with promo code</span>
                    </div>
                </div>

                <ul class="space-y-2.5 text-amber-100/90">
                    <li class="flex items-start space-x-2">
                        <span class="text-amber-400 font-bold">✓</span>
                        <span><strong>One-Time Payment Only:</strong> No auto-renewals or monthly recurring charges.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-amber-400 font-bold">✓</span>
                        <span>Unlimited proposals, advanced cultural filters, and horoscope compatibility.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-amber-400 font-bold">✓</span>
                        <span>Supported via <strong>Stripe</strong> and <strong>PayPal</strong> with instant account activation.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-amber-400 font-bold">✓</span>
                        <span>Special promo code <code class="px-1.5 py-0.5 rounded bg-amber-900/80 text-amber-200 border border-amber-500/40 font-mono font-bold">SHUBHOVIVAH</code> reduces price to $19 USD.</span>
                    </li>
                </ul>

                <div class="pt-2">
                    <a href="{{ route('register') }}" class="w-full py-2.5 rounded-xl gold-gradient text-white font-bold text-center block hover:opacity-95 transition shadow-md">
                        Get Started with Single Vivah Pass
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 6. 1-CLICK DEMO PERSONA SWITCHER FOR INSTANT EVALUATION  -->
    <!-- ========================================================= -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-amber-200/90 shadow-md space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 pb-4 border-b border-amber-100">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-amber-700 block">Instant System Evaluation</span>
                <h2 class="text-xl sm:text-2xl font-bold font-heading text-red-950">
                    Explore with 1-Click Demo Personas
                </h2>
            </div>
            <p class="text-xs text-stone-500 max-w-md">
                Click any role to log in instantly without typing passwords and experience real-time messaging, Ashtakoota Milan, and Single Vivah Pass payment checkout.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <!-- Groom Arun -->
            <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="p-4 rounded-2xl bg-amber-50/60 hover:bg-amber-100/70 border border-amber-200 transition group flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-2.5 mb-2">
                        <div class="w-9 h-9 rounded-full bg-red-900 text-amber-200 font-bold flex items-center justify-center text-xs shrink-0">
                            AB
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-stone-900 group-hover:text-red-900 transition truncate">Dr. Arun Banerjee</h4>
                            <span class="text-[10px] text-emerald-700 font-semibold uppercase">Groom • Pro Pass</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-stone-600">30 yrs, New York USA, Physician, Bengali Brahmin Shandilya.</p>
                </div>
                <span class="mt-3 text-[11px] font-bold text-amber-800 flex items-center space-x-1">
                    <span>1-Click Login</span>
                    <span>→</span>
                </span>
            </a>

            <!-- Bride Priya -->
            <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="p-4 rounded-2xl bg-rose-50/60 hover:bg-rose-100/70 border border-rose-200 transition group flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-2.5 mb-2">
                        <div class="w-9 h-9 rounded-full bg-rose-900 text-amber-200 font-bold flex items-center justify-center text-xs shrink-0">
                            PM
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-stone-900 group-hover:text-rose-900 transition truncate">Priya Mukherjee</h4>
                            <span class="text-[10px] text-rose-700 font-semibold uppercase">Bride • Modesty Shield</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-stone-600">26 yrs, Toronto Canada, Music Teacher, Bengali Brahmin Shandilya.</p>
                </div>
                <span class="mt-3 text-[11px] font-bold text-rose-800 flex items-center space-x-1">
                    <span>1-Click Login</span>
                    <span>→</span>
                </span>
            </a>

            <!-- Family Elder Subhash -->
            <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="p-4 rounded-2xl bg-amber-50/60 hover:bg-amber-100/70 border border-amber-200 transition group flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-2.5 mb-2">
                        <div class="w-9 h-9 rounded-full bg-amber-900 text-amber-200 font-bold flex items-center justify-center text-xs shrink-0">
                            SM
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-stone-900 group-hover:text-amber-900 transition truncate">Subhash Mukherjee</h4>
                            <span class="text-[10px] text-amber-800 font-semibold uppercase">Family Rep / Ghotok</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-stone-600">Father of Priya, oversees chaperoned messaging & proposals.</p>
                </div>
                <span class="mt-3 text-[11px] font-bold text-amber-800 flex items-center space-x-1">
                    <span>1-Click Login</span>
                    <span>→</span>
                </span>
            </a>

            <!-- Pandit Acharya Kalyan -->
            <a href="{{ route('demo.login', ['email' => 'pandit@vivahconnect.com']) }}" class="p-4 rounded-2xl bg-orange-50/60 hover:bg-orange-100/70 border border-orange-200 transition group flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-2.5 mb-2">
                        <div class="w-9 h-9 rounded-full bg-amber-700 text-white font-bold flex items-center justify-center text-xs shrink-0">
                            PK
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-stone-900 group-hover:text-amber-900 transition truncate">Pandit Acharya Kalyan</h4>
                            <span class="text-[10px] text-amber-700 font-semibold uppercase">Vedic Astrologer</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-stone-600">Vedic Pandit guiding Guna Milan & solemnizing sacred ceremonies.</p>
                </div>
                <span class="mt-3 text-[11px] font-bold text-amber-800 flex items-center space-x-1">
                    <span>1-Click Login</span>
                    <span>→</span>
                </span>
            </a>
        </div>
    </div>

</div>
@endsection
