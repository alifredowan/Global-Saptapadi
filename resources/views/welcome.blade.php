@extends('layouts.app')

@section('content')
<div class="space-y-12 py-2">

    <!-- ========================================================= -->
    <!-- 1. CURVED FLOATING HERO CONTAINER (Design Kit Screen 1)   -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto">
        <section class="card-ledger pattern-header rounded-2xl sm:rounded-3xl p-6 sm:p-10 lg:p-12 bg-[var(--bg-surface)] border border-[var(--border-default)]">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Left Column (7 cols): Sincere Left-Aligned Headline & Trust Signals -->
                <div class="lg:col-span-7 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-border)] text-[var(--accent-text)] text-xs font-bold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)]"></span>
                        <span>Sacred Matrimonial Union • Global Dharmic Diaspora</span>
                    </div>

                    <h1 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-5xl text-[var(--text-primary)] tracking-tight leading-tight">
                        Where Sacred Traditions Meet Authentic Life Partnerships
                    </h1>

                    <p class="text-sm sm:text-base text-[var(--text-secondary)] leading-relaxed max-w-2xl">
                        A dignified matrimonial directory for practicing candidates and their families. Connecting brides, grooms, and guardians across the worldwide diaspora with <strong>36-Point Ashtakoota Guna Milan</strong>, <strong>Gotra lineage verification</strong>, <strong>100% ID KYC trust</strong>, and <strong>transparent non-commercial ethics</strong>.
                    </p>

                    <!-- 3-Point Monoline Trust Checklist -->
                    <div class="pt-2 space-y-2.5 text-xs text-[var(--text-secondary)]">
                        <div class="flex items-center space-x-2.5">
                            <span class="w-5 h-5 rounded-full bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)] flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                            <span><strong>100% ID & Biometric Verification:</strong> Government credential checks to eliminate deceitful profiles.</span>
                        </div>
                        <div class="flex items-center space-x-2.5">
                            <span class="w-5 h-5 rounded-full bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)] flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                            <span><strong>Customary Lineage Integrity:</strong> Sagotra avoidance checks and Manglik status analysis.</span>
                        </div>
                        <div class="flex items-center space-x-2.5">
                            <span class="w-5 h-5 rounded-full bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)] flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                            <span><strong>Family Guardian Chaperone:</strong> 3-way chaperoned dialogue and default photo modesty protection.</span>
                        </div>
                    </div>

                    <!-- Call-to-Action Buttons -->
                    <div class="flex flex-wrap items-center gap-3 pt-4">
                        <a href="{{ route('register') }}" class="btn-primary text-xs font-bold !px-6 !py-2.5 shadow-sm">
                            Create Sacred Biodata (Free)
                        </a>
                        <a href="{{ route('login') }}" class="btn-secondary text-xs font-semibold !px-5 !py-2.5">
                            Sign In to Portal &rarr;
                        </a>
                        <a href="#sacred-pillars" class="btn-subtle text-xs font-medium !px-3">
                            Explore Sacred Process &darr;
                        </a>
                    </div>
                </div>

                <!-- Right Column (5 cols): Instant Match Finder Form inside Card Ledger -->
                <div class="lg:col-span-5">
                    <div class="card-ledger p-6 sm:p-7 bg-[var(--bg-canvas)] border border-[var(--border-default)] rounded-[var(--radius-md)] space-y-4">
                        <div class="border-b border-[var(--border-subtle)] pb-3">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Dharmic Search Engine</span>
                            <h2 class="text-lg font-bold font-heading text-[var(--text-primary)]">
                                Find Compatible Dharmic Matches
                            </h2>
                            <p class="text-[12px] text-[var(--text-muted)] mt-0.5">
                                Discover candidates calibrated with Vedic Guna Milan and lineage safeguards.
                            </p>
                        </div>

                        <form action="{{ route('discovery.index') }}" method="GET" class="space-y-3.5">
                            <!-- Looking For -->
                            <div>
                                <label class="block font-bold text-[var(--text-secondary)] uppercase mb-1 text-[11px]">Looking For</label>
                                <select name="gender" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] focus:ring-1 focus:ring-[var(--accent-primary)] text-xs text-[var(--text-primary)] font-medium">
                                    <option value="female">Dharmic Bride (Kanya)</option>
                                    <option value="male">Dharmic Groom (Var)</option>
                                </select>
                            </div>

                            <!-- Age Range -->
                            <div>
                                <label class="block font-bold text-[var(--text-secondary)] uppercase mb-1 text-[11px]">Age Range</label>
                                <div class="flex items-center space-x-2">
                                    <input type="number" name="min_age" value="21" min="18" max="70" class="w-1/2 px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-center font-medium">
                                    <span class="text-[var(--text-muted)] text-xs">to</span>
                                    <input type="number" name="max_age" value="35" min="18" max="70" class="w-1/2 px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-center font-medium">
                                </div>
                            </div>

                            <!-- Diaspora Country -->
                            <div>
                                <label class="block font-bold text-[var(--text-secondary)] uppercase mb-1 text-[11px]">Diaspora Region</label>
                                <select name="country" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)] font-medium">
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
                                <label class="block font-bold text-[var(--text-secondary)] uppercase mb-1 text-[11px]">Sampradaya</label>
                                <select name="sampradaya" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)] font-medium">
                                    <option value="">Any Tradition</option>
                                    <option value="Vaishnav">Vaishnav</option>
                                    <option value="Shaiva">Shaiva</option>
                                    <option value="Shakta">Shakta</option>
                                    <option value="Smarta">Smarta</option>
                                    <option value="ISKCON">ISKCON</option>
                                </select>
                            </div>

                            <!-- Dietary Sanskar -->
                            <div>
                                <label class="block font-bold text-[var(--text-secondary)] uppercase mb-1 text-[11px]">Dietary Sanskar</label>
                                <select name="diet" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-xs text-[var(--text-primary)] font-medium">
                                    <option value="">Any Diet</option>
                                    <option value="vegetarian">Vegetarian</option>
                                    <option value="jain">Jain (Sattvic)</option>
                                    <option value="vegan">Vegan</option>
                                    <option value="eggetarian">Eggetarian</option>
                                </select>
                            </div>

                            <button type="submit" class="btn-primary w-full text-xs font-bold !mt-4">
                                Search Compatible Matches &rarr;
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 2. FOUR SACRED STAGES OF VEDIC UNION (LEDGER GRID)        -->
    <!-- ========================================================= -->
    <div id="sacred-pillars" class="max-w-7xl mx-auto space-y-6">
        <div class="border-b border-[var(--border-default)] pb-4">
            <span class="text-xs font-bold uppercase tracking-widest text-[var(--accent-primary)]">The Authentic Matrimonial Path</span>
            <h2 class="text-2xl font-bold font-heading text-[var(--text-primary)] mt-0.5">
                4 Sacred Stages of Vedic Matrimonial Union
            </h2>
            <p class="text-xs text-[var(--text-secondary)] mt-1">
                A solemn, dignified journey designed to honor Vedic rituals, parental respect, and individual aspirations.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <!-- Stage 1 -->
            <div class="card-ledger p-5 flex flex-col justify-between">
                <div>
                    <div class="w-9 h-9 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-border)] text-[var(--accent-text)] font-bold text-sm flex items-center justify-center mb-3">
                        1
                    </div>
                    <span class="text-[10px] font-bold text-[var(--text-muted)] uppercase tracking-wider block">Stage I • Satya</span>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] mt-1 mb-2">Dharmic Biodata & Trust KYC</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Comprehensive profile setup including paternal and maternal Gotra, spiritual habits, diet, and education. Verified via 100% government ID & biometric liveness.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[var(--border-subtle)] text-[11px] font-semibold text-[var(--color-success)] flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Zero Fake Accounts</span>
                </div>
            </div>

            <!-- Stage 2 -->
            <div class="card-ledger p-5 flex flex-col justify-between">
                <div>
                    <div class="w-9 h-9 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] font-bold text-sm flex items-center justify-center mb-3">
                        2
                    </div>
                    <span class="text-[10px] font-bold text-[var(--text-muted)] uppercase tracking-wider block">Stage II • Sanskar</span>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] mt-1 mb-2">36-Point Ashtakoota Guna Milan</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Precision astrological calculation across 8 sacred Kootas (Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, Nadi) with Sagotra warnings.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[var(--border-subtle)] text-[11px] font-semibold text-[var(--secondary-text)] flex items-center space-x-1.5">
                    <span>•</span>
                    <span>Astrological Lineage Integrity</span>
                </div>
            </div>

            <!-- Stage 3 -->
            <div class="card-ledger p-5 flex flex-col justify-between">
                <div>
                    <div class="w-9 h-9 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-border)] text-[var(--accent-text)] font-bold text-sm flex items-center justify-center mb-3">
                        3
                    </div>
                    <span class="text-[10px] font-bold text-[var(--text-muted)] uppercase tracking-wider block">Stage III • Kula Gaurav</span>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] mt-1 mb-2">Chaperoned Family Dialogue</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Real-time WebSockets messaging with designated family elders or community Ghotoks. Protected contact shield hides phone until mutual consent.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[var(--border-subtle)] text-[11px] font-semibold text-[var(--accent-text)] flex items-center space-x-1.5">
                    <span>🛡️</span>
                    <span>Protected Contact Shield</span>
                </div>
            </div>

            <!-- Stage 4 -->
            <div class="card-ledger p-5 flex flex-col justify-between">
                <div>
                    <div class="w-9 h-9 rounded-[var(--radius-sm)] bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-[var(--color-success)] font-bold text-sm flex items-center justify-center mb-3">
                        4
                    </div>
                    <span class="text-[10px] font-bold text-[var(--text-muted)] uppercase tracking-wider block">Stage IV • Shubho Bibaho</span>
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)] mt-1 mb-2">Sacred Marriage Solemnization</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        Upon sacred rites, both families register their union in the Shubho Bibaho Registry to receive a digital marriage certificate and exit the pool.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[var(--border-subtle)] text-[11px] font-semibold text-[var(--color-success)] flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Immutable Registry</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 3. CANDIDATE PREVIEW SHOWCASE (PROFILE-CARD.HTML SPEC)    -->
    <!-- ========================================================= -->
    <div id="candidates" class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2 border-b border-[var(--border-default)]">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-[var(--accent-primary)]">Verified Seekers</span>
                <h2 class="text-xl sm:text-2xl font-bold font-heading text-[var(--text-primary)]">
                    Sample Candidate Previews
                </h2>
            </div>
            <a href="{{ route('register') }}" class="text-xs font-bold text-[var(--accent-primary)] hover:underline flex items-center space-x-1">
                <span>Join to browse all candidate profiles</span>
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @forelse($featuredCandidates as $candidate)
                @php
                    $profile = $candidate->profile;
                    $kundli = $candidate->kundli;
                @endphp
                <article class="card-ledger flex flex-col justify-between overflow-hidden">
                    <div>
                        <!-- Photo Container with Modesty Shield -->
                        <div class="relative h-52 bg-[var(--bg-muted)] overflow-hidden">
                            <img src="{{ $candidate->primary_photo_url }}" 
                                 alt="{{ $candidate->name }}" 
                                 class="w-full h-full object-cover {{ $candidate->gender === 'female' ? 'photo-shield' : '' }}">

                            <!-- Top Badges -->
                            <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between pointer-events-none">
                                <span class="badge-verified shadow-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Verified Seeker</span>
                                </span>
                                <span class="badge-status bg-[var(--bg-surface)] text-[var(--accent-primary)] border border-[var(--accent-border)]">
                                    {{ $candidate->id === 3 ? '89%' : ($candidate->id === 4 ? '70%' : '85%') }} Match
                                </span>
                            </div>

                            @if($candidate->gender === 'female')
                            <!-- Modesty Notice -->
                            <div class="absolute inset-0 bg-stone-900/40 backdrop-blur-xs flex flex-col items-center justify-center text-center p-3 text-white">
                                <span class="font-bold text-[11px] uppercase tracking-wider text-amber-200">Modesty Photo Shield</span>
                                <span class="text-[10px] text-stone-200 mt-0.5">Unlocks upon mutual consent</span>
                            </div>
                            @endif

                            <div class="absolute bottom-2.5 inset-x-3 text-white">
                                <h3 class="font-heading font-bold text-sm text-white truncate drop-shadow-sm">
                                    {{ $candidate->name }}
                                </h3>
                                <p class="text-[11px] text-amber-100 font-medium truncate mt-0.5 drop-shadow-xs">
                                    {{ $candidate->age ?? 28 }} yrs • {{ $profile?->city ?? 'Diaspora' }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Metadata -->
                        <div class="p-3.5 space-y-2 text-xs">
                            <div class="grid grid-cols-2 gap-2 p-2 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] text-[11px]">
                                <div>
                                    <span class="text-[var(--text-muted)] block text-[9px] uppercase font-bold">Gotra</span>
                                    <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->gotra ?? 'Shandilya' }}</span>
                                </div>
                                <div>
                                    <span class="text-[var(--text-muted)] block text-[9px] uppercase font-bold">Sampradaya</span>
                                    <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->sampradaya ?? 'Vaishnav' }}</span>
                                </div>
                                <div>
                                    <span class="text-[var(--text-muted)] block text-[9px] uppercase font-bold">Profession</span>
                                    <span class="font-semibold text-[var(--text-primary)] truncate block">{{ $profile?->profession ?? 'Professional' }}</span>
                                </div>
                                <div>
                                    <span class="text-[var(--text-muted)] block text-[9px] uppercase font-bold">Diet</span>
                                    <span class="font-semibold text-[var(--text-primary)] capitalize truncate block">{{ $profile?->diet ?? 'Vegetarian' }}</span>
                                </div>
                            </div>

                            <div class="p-2 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-border)] text-[11px] flex items-center justify-between">
                                <span class="text-[var(--accent-text)] font-semibold">36-Point Ashtakoota Guna Milan</span>
                                <span class="font-extrabold text-[var(--accent-primary)]">
                                    {{ $candidate->id === 3 ? '29.5' : ($candidate->id === 4 ? '17.5' : '26.0') }} / 36
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="p-3.5 pt-0">
                        <a href="{{ route('login') }}" class="btn-secondary w-full text-xs font-semibold !min-h-[36px] text-center">
                            Sign In to View Full Biodata
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-4 text-center py-8 text-[var(--text-muted)] text-xs">
                    Candidate previews currently loading.
                </div>
            @endforelse
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 4. SINGLE VIVAH PASS: NON-RECURRING MATRIMONIAL ETHICS    -->
    <!-- ========================================================= -->
    <div id="single-pass" class="max-w-7xl mx-auto">
        <section class="card-ledger p-8 sm:p-10 border border-[var(--border-default)] rounded-2xl sm:rounded-3xl space-y-6">
            <div class="max-w-2xl mx-auto text-center space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Authentic Non-Commercial Ethics</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-[var(--text-primary)]">
                    Single Vivah Pass • $29 USD (One-Time Fee)
                </h2>
                <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed">
                    <strong>We reject monthly subscription billing traps.</strong> Commercial apps profit by keeping seekers searching month after month. Vivah Connect aligns its purpose with your sacred union: pay once for a single marriage journey.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto pt-2">
                <!-- Commercial Trap Card -->
                <div class="card-ledger p-6 bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs space-y-3.5">
                    <div class="flex items-center justify-between pb-2 border-b border-[var(--border-subtle)]">
                        <span class="font-bold text-[var(--text-secondary)] uppercase tracking-wider">Commercial Portals</span>
                        <span class="text-[var(--color-danger)] font-bold">$35–$60 / Month</span>
                    </div>
                    <ul class="space-y-2 text-[var(--text-secondary)]">
                        <li class="flex items-start space-x-2">
                            <span class="text-[var(--color-danger)] font-bold">✗</span>
                            <span>Recurring monthly auto-renewals that silently rebill your card.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-[var(--color-danger)] font-bold">✗</span>
                            <span>Financial incentive to prolong search rather than solemnize marriage.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-[var(--color-danger)] font-bold">✗</span>
                            <span>Casual dating profiles, unverified phone numbers, and automated bots.</span>
                        </li>
                    </ul>
                </div>

                <!-- Single Vivah Pass Card -->
                <div class="card-ledger p-6 bg-[var(--accent-subtle)] border-2 border-[var(--accent-border)] text-xs space-y-3.5 relative">
                    <div class="flex items-center justify-between pb-2 border-b border-[var(--accent-border)]">
                        <div>
                            <span class="font-heading font-bold text-sm text-[var(--accent-primary)] block">Single Vivah Pass</span>
                            <span class="text-[10px] text-[var(--text-muted)]">Valid until Shubho Bibaho Marriage</span>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-black text-[var(--accent-primary)]">$29 USD</span>
                            <span class="block text-[10px] text-[var(--text-muted)]">$19 with code SHUBHOVIVAH</span>
                        </div>
                    </div>
                    <ul class="space-y-2 text-[var(--text-secondary)]">
                        <li class="flex items-start space-x-2">
                            <span class="text-[var(--color-success)] font-bold">✓</span>
                            <span><strong>One-Time Payment Only:</strong> No auto-renewals or recurring charges.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-[var(--color-success)] font-bold">✓</span>
                            <span>Unlimited proposals, advanced cultural filters, and 36-Guna Kundli scores.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-[var(--color-success)] font-bold">✓</span>
                            <span>Instant activation via Stripe, PayPal, and Apple Pay.</span>
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn-primary w-full text-xs font-bold text-center block !mt-4">
                        Get Started with Single Vivah Pass
                    </a>
                </div>
            </div>
        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 5. 1-CLICK DEMO PERSONA SWITCHER                          -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto">
        <div class="card-ledger p-6 sm:p-8 space-y-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 pb-3 border-b border-[var(--border-subtle)]">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)] block">Instant System Evaluation</span>
                    <h2 class="text-lg sm:text-xl font-bold font-heading text-[var(--text-primary)]">
                        Explore with 1-Click Demo Personas
                    </h2>
                </div>
                <p class="text-xs text-[var(--text-muted)] max-w-md">
                    Click any persona to log in instantly without typing passwords and experience real-time messaging, Ashtakoota Milan, and Single Vivah Pass checkout.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
                <!-- Groom Arun -->
                <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="card-ledger p-4 hover:border-[var(--border-strong)] transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-2.5 mb-2">
                            <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white font-bold flex items-center justify-center text-xs shrink-0">
                                AB
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] transition truncate">Dr. Arun Banerjee</h4>
                                <span class="text-[10px] text-[var(--color-success)] font-semibold uppercase">Groom • Pro Pass</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)]">30 yrs, New York USA, Physician, Bengali Brahmin Shandilya.</p>
                    </div>
                    <span class="mt-3 text-[11px] font-bold text-[var(--accent-primary)] flex items-center space-x-1">
                        <span>1-Click Login</span>
                        <span>&rarr;</span>
                    </span>
                </a>

                <!-- Bride Priya -->
                <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="card-ledger p-4 hover:border-[var(--border-strong)] transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-2.5 mb-2">
                            <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--secondary-primary)] text-white font-bold flex items-center justify-center text-xs shrink-0">
                                PM
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] transition truncate">Priya Mukherjee</h4>
                                <span class="text-[10px] text-[var(--secondary-text)] font-semibold uppercase">Bride • Modesty Shield</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)]">26 yrs, Toronto Canada, Music Teacher, Bengali Brahmin Shandilya.</p>
                    </div>
                    <span class="mt-3 text-[11px] font-bold text-[var(--secondary-text)] flex items-center space-x-1">
                        <span>1-Click Login</span>
                        <span>&rarr;</span>
                    </span>
                </a>

                <!-- Family Elder Subhash -->
                <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="card-ledger p-4 hover:border-[var(--border-strong)] transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-2.5 mb-2">
                            <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--bg-muted)] text-[var(--text-primary)] font-bold flex items-center justify-center text-xs shrink-0">
                                SM
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] transition truncate">Subhash Mukherjee</h4>
                                <span class="text-[10px] text-[var(--text-muted)] font-semibold uppercase">Family Rep / Ghotok</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)]">Father of Priya, oversees chaperoned messaging & proposals.</p>
                    </div>
                    <span class="mt-3 text-[11px] font-bold text-[var(--text-secondary)] flex items-center space-x-1">
                        <span>1-Click Login</span>
                        <span>&rarr;</span>
                    </span>
                </a>

                <!-- Pandit Acharya Kalyan -->
                <a href="{{ route('demo.login', ['email' => 'pandit@vivahconnect.com']) }}" class="card-ledger p-4 hover:border-[var(--border-strong)] transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-2.5 mb-2">
                            <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-hover)] text-white font-bold flex items-center justify-center text-xs shrink-0">
                                PK
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] transition truncate">Pandit Acharya Kalyan</h4>
                                <span class="text-[10px] text-[var(--accent-text)] font-semibold uppercase">Vedic Astrologer</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-[var(--text-secondary)]">Vedic Pandit guiding Guna Milan & solemnizing sacred ceremonies.</p>
                    </div>
                    <span class="mt-3 text-[11px] font-bold text-[var(--accent-primary)] flex items-center space-x-1">
                        <span>1-Click Login</span>
                        <span>&rarr;</span>
                    </span>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
