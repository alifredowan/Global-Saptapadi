@extends('layouts.app')

@section('content')
<div class="space-y-12 sm:space-y-16 pt-2 pb-0">

    <!-- ========================================================= -->
    <!-- 1. HERO: BOLD, VISUAL & FOCUSED                           -->
    <!-- Max 8 words headline, 1 short sub-line, strong visual CTA  -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="card-ledger relative overflow-hidden p-6 sm:p-10 lg:p-12 bg-[var(--bg-surface)]">
            
            <!-- Corner Alpona Line Pattern (low opacity 6%) -->
            <div class="absolute top-0 right-0 pointer-events-none opacity-[0.06] text-[var(--color-accent)] hidden sm:block" aria-hidden="true">
                <svg width="180" height="180" viewBox="0 0 180 180" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="180" cy="0" r="140" stroke-dasharray="4 6"/>
                    <circle cx="180" cy="0" r="100"/>
                    <circle cx="180" cy="0" r="60" stroke-dasharray="3 4"/>
                    <path d="M40 0 L180 0 M180 0 L180 140"/>
                </svg>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center relative z-10">
                
                <!-- Left (7 cols): Editorial Focal Point -->
                <div class="lg:col-span-7 space-y-5">
                    
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] text-xs font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--secondary-primary)]"></span>
                        <span>Seven steps. One lifetime.</span>
                    </div>

                    <h1 class="font-serif font-bold text-3xl sm:text-5xl text-[var(--text-primary)] tracking-tight leading-[1.15]">
                        Seven sacred steps. One lifelong union.
                    </h1>

                    <p class="text-base sm:text-lg text-[var(--text-secondary)] leading-relaxed max-w-xl font-normal">
                        Dignified Hindu matrimony for intentional seekers and families across the UK, USA, Canada, UAE, Singapore, India, Bangladesh, and Nepal.
                    </p>

                    <!-- CTAs -->
                    <div class="pt-2 flex flex-wrap items-center gap-3.5">
                        <a href="{{ route('register') }}" class="btn-primary !h-[48px] !px-6 !text-[15px] font-semibold">
                            <span>Create free profile</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                        </a>
                        <a href="#how-it-works" class="btn-secondary !h-[48px] !px-5 !text-[15px] font-medium">
                            How it works
                        </a>
                    </div>

                    <!-- Trust Chips -->
                    <div class="pt-3 flex flex-wrap items-center gap-4 text-xs font-medium text-[var(--text-secondary)]">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[var(--color-success)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Verified profiles
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                            Family approval
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                            Photos stay private
                        </span>
                    </div>

                </div>

                <!-- Right (5 cols): Composition of Sample Candidate Profiles -->
                <div id="candidates" class="lg:col-span-5 space-y-3">
                    <div class="p-4 sm:p-5 rounded-[var(--radius-md)] bg-[var(--bg-canvas)] border border-[var(--border-default)] space-y-3 shadow-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-[var(--border-subtle)]">
                            <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Verified Sample Profiles</span>
                            <span class="text-[11px] text-[var(--text-muted)] font-medium">Worldwide diaspora</span>
                        </div>

                        <!-- Candidate 1: Aarav (London) -->
                        <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-full bg-stone-200 border border-[var(--border-default)] flex items-center justify-center font-serif font-bold text-xs text-[var(--accent-primary)] shrink-0">
                                    AS
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <h4 class="font-bold text-xs text-[var(--text-primary)] truncate">Aarav Sharma</h4>
                                        <span class="w-2 h-2 rounded-full bg-[var(--color-success)]" title="Verified"></span>
                                    </div>
                                    <p class="text-[11px] text-[var(--text-secondary)] truncate">30 yrs &bull; London, UK &bull; Consultant</p>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--color-success-bg)] text-[var(--color-success)] shrink-0">
                                32/36 Guna
                            </span>
                        </div>

                        <!-- Candidate 2: Ananya (Toronto) -->
                        <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-full bg-amber-100 border border-[var(--secondary-border)] flex items-center justify-center font-serif font-bold text-xs text-[var(--secondary-text)] shrink-0">
                                    AI
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <h4 class="font-bold text-xs text-[var(--text-primary)] truncate">Ananya Iyer</h4>
                                        <span class="w-2 h-2 rounded-full bg-[var(--color-success)]" title="Verified"></span>
                                    </div>
                                    <p class="text-[11px] text-[var(--text-secondary)] truncate">27 yrs &bull; Toronto, Canada &bull; Architect</p>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--secondary-subtle)] text-[var(--secondary-text)] shrink-0">
                                Veiled Photo
                            </span>
                        </div>

                        <!-- Candidate 3: Rohan (Dubai) -->
                        <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-full bg-stone-200 border border-[var(--border-default)] flex items-center justify-center font-serif font-bold text-xs text-stone-700 shrink-0">
                                    RM
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <h4 class="font-bold text-xs text-[var(--text-primary)] truncate">Rohan Mehta</h4>
                                        <span class="w-2 h-2 rounded-full bg-[var(--color-success)]" title="Verified"></span>
                                    </div>
                                    <p class="text-[11px] text-[var(--text-secondary)] truncate">29 yrs &bull; Dubai, UAE &bull; Data Lead</p>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--color-success-bg)] text-[var(--color-success)] shrink-0">
                                30/36 Guna
                            </span>
                        </div>

                        <a href="{{ route('discovery.index') }}" class="btn-primary w-full !min-h-[42px] !h-[42px] !text-xs font-semibold text-center block">
                            Explore All Candidate Profiles
                        </a>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 2. HOW IT WORKS: THE SEVEN STEPS (SAPTAPADI PATH)         -->
    <!-- Footprint path, large step numbers, icon & 3-4 words each  -->
    <!-- ========================================================= -->
    <div id="how-it-works" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="card-ledger p-6 sm:p-10 space-y-8 bg-[var(--bg-surface)]">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Vedic Journey</span>
                <h2 class="text-2xl sm:text-3xl font-bold font-serif text-[var(--text-primary)]">
                    The Seven Sacred Steps (Saptapadi)
                </h2>
                <p class="text-sm text-[var(--text-secondary)] max-w-lg mx-auto">
                    In Vedic tradition, seven steps around the sacred fire unite two lives for a lifetime.
                </p>
            </div>

            <!-- Responsive Step Tracker: Desktop Horizontal, Mobile Vertical -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-4 text-center">
                
                <!-- Step 1 -->
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex flex-col items-center space-y-2">
                    <span class="w-8 h-8 rounded-full bg-[var(--accent-subtle)] text-[var(--accent-primary)] font-serif font-bold text-sm flex items-center justify-center">1</span>
                    <h3 class="font-bold text-sm text-[var(--text-primary)]">Profile</h3>
                    <p class="text-[12px] text-[var(--text-secondary)]">Create sacred biodata</p>
                </div>

                <!-- Step 2 -->
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex flex-col items-center space-y-2">
                    <span class="w-8 h-8 rounded-full bg-[var(--accent-subtle)] text-[var(--accent-primary)] font-serif font-bold text-sm flex items-center justify-center">2</span>
                    <h3 class="font-bold text-sm text-[var(--text-primary)]">Kundli</h3>
                    <p class="text-[12px] text-[var(--text-secondary)]">Optional birth chart</p>
                </div>

                <!-- Step 3 -->
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex flex-col items-center space-y-2">
                    <span class="w-8 h-8 rounded-full bg-[var(--accent-subtle)] text-[var(--accent-primary)] font-serif font-bold text-sm flex items-center justify-center">3</span>
                    <h3 class="font-bold text-sm text-[var(--text-primary)]">Discover</h3>
                    <p class="text-[12px] text-[var(--text-secondary)]">Explore intentional matches</p>
                </div>

                <!-- Step 4 -->
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex flex-col items-center space-y-2">
                    <span class="w-8 h-8 rounded-full bg-[var(--accent-subtle)] text-[var(--accent-primary)] font-serif font-bold text-sm flex items-center justify-center">4</span>
                    <h3 class="font-bold text-sm text-[var(--text-primary)]">Interest</h3>
                    <p class="text-[12px] text-[var(--text-secondary)]">Express mutual respect</p>
                </div>

                <!-- Step 5 -->
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex flex-col items-center space-y-2">
                    <span class="w-8 h-8 rounded-full bg-[var(--accent-subtle)] text-[var(--accent-primary)] font-serif font-bold text-sm flex items-center justify-center">5</span>
                    <h3 class="font-bold text-sm text-[var(--text-primary)]">Family</h3>
                    <p class="text-[12px] text-[var(--text-secondary)]">Elder review &amp; consent</p>
                </div>

                <!-- Step 6 -->
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] flex flex-col items-center space-y-2">
                    <span class="w-8 h-8 rounded-full bg-[var(--accent-subtle)] text-[var(--accent-primary)] font-serif font-bold text-sm flex items-center justify-center">6</span>
                    <h3 class="font-bold text-sm text-[var(--text-primary)]">Chat</h3>
                    <p class="text-[12px] text-[var(--text-secondary)]">Chaperoned conversations</p>
                </div>

                <!-- Step 7 -->
                <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] flex flex-col items-center space-y-2">
                    <span class="w-8 h-8 rounded-full bg-[var(--secondary-primary)] text-white font-serif font-bold text-sm flex items-center justify-center">7</span>
                    <h3 class="font-bold text-sm text-[var(--secondary-text)]">Vivah</h3>
                    <p class="text-[12px] text-[var(--secondary-text)] font-medium">Sacred marriage solemnized</p>
                </div>

            </div>
        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 3. VISUAL PRODUCT HIGHLIGHTS                              -->
    <!-- 4 Mock Screen Cards with One Line of Text Each            -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="space-y-6">
            <div class="text-center max-w-xl mx-auto space-y-1">
                <span class="text-xs font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Design Built For Trust</span>
                <h2 class="text-2xl font-bold font-serif text-[var(--text-primary)]">Thoughtful Matrimonial Privacy</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- Mock 1: Modest Photo Shield -->
                <div class="card-ledger p-5 space-y-3 bg-[var(--bg-surface)]">
                    <div class="w-9 h-9 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">Photo Veil Shield</h3>
                    <p class="text-xs text-[var(--text-secondary)]">Portraits remain softly blurred until mutual family acceptance.</p>
                </div>

                <!-- Mock 2: 36-Point Guna Milan -->
                <div class="card-ledger p-5 space-y-3 bg-[var(--bg-surface)]">
                    <div class="w-9 h-9 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] text-[var(--secondary-text)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a14.5 14.5 0 0 0 0 18M12 3a14.5 14.5 0 0 1 0 18M3 12h18"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">36-Guna Kundli Score</h3>
                    <p class="text-xs text-[var(--text-secondary)]">Instant Ashtakoota compatibility analysis with Sagotra safety checks.</p>
                </div>

                <!-- Mock 3: Elder Console -->
                <div class="card-ledger p-5 space-y-3 bg-[var(--bg-surface)]">
                    <div class="w-9 h-9 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">Family Elder Console</h3>
                    <p class="text-xs text-[var(--text-secondary)]">Parents participate free with transparent chaperone controls.</p>
                </div>

                <!-- Mock 4: Contact Shield -->
                <div class="card-ledger p-5 space-y-3 bg-[var(--bg-surface)]">
                    <div class="w-9 h-9 rounded-[var(--radius-sm)] bg-[var(--secondary-subtle)] text-[var(--secondary-text)] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/></svg>
                    </div>
                    <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">Contact Shield</h3>
                    <p class="text-xs text-[var(--text-secondary)]">Direct phone numbers stay protected against unwanted solicitations.</p>
                </div>

            </div>
        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 4. SUCCESS STORIES (SHUBHO BIBAHO)                        -->
    <!-- Visual couple cards, city, wedding month, one-line quote   -->
    <!-- ========================================================= -->
    <div id="success-stories" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="card-ledger p-6 sm:p-10 space-y-6 bg-[var(--bg-surface)]">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-[var(--border-subtle)]">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Sacred Testimonials</span>
                    <h2 class="text-2xl font-bold font-serif text-[var(--text-primary)]">Shubho Bibaho Couples</h2>
                </div>
                @auth
                <a href="{{ route('milestone.index') }}" class="text-xs font-semibold text-[var(--accent-primary)] hover:underline self-start sm:self-center">
                    Declare Your Milestone &rarr;
                </a>
                @else
                <a href="{{ route('register') }}" class="text-xs font-semibold text-[var(--accent-primary)] hover:underline self-start sm:self-center">
                    Begin Your Story &rarr;
                </a>
                @endauth
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                
                <!-- Couple 1 -->
                <div class="p-5 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-[var(--accent-primary)] text-white font-serif font-bold flex items-center justify-center text-xs shrink-0">
                            R&amp;M
                        </div>
                        <div>
                            <h4 class="font-serif font-bold text-base text-[var(--text-primary)]">Rohan &amp; Meera</h4>
                            <span class="text-[11px] text-[var(--text-muted)]">London &bull; Married Oct 2025</span>
                        </div>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] italic leading-relaxed">
                        &ldquo;Our parents reviewed Kundli matches calmly without awkward sales calls or recurring charges.&rdquo;
                    </p>
                </div>

                <!-- Couple 2 -->
                <div class="p-5 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-[var(--secondary-primary)] text-white font-serif font-bold flex items-center justify-center text-xs shrink-0">
                            A&amp;P
                        </div>
                        <div>
                            <h4 class="font-serif font-bold text-base text-[var(--text-primary)]">Arjun &amp; Priya</h4>
                            <span class="text-[11px] text-[var(--text-muted)]">Toronto &bull; Married Jan 2026</span>
                        </div>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] italic leading-relaxed">
                        &ldquo;Photo privacy gave us peace of mind until our families felt genuine mutual resonance.&rdquo;
                    </p>
                </div>

                <!-- Couple 3 -->
                <div class="p-5 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] border border-[var(--border-default)] space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-emerald-800 text-white font-serif font-bold flex items-center justify-center text-xs shrink-0">
                            A&amp;A
                        </div>
                        <div>
                            <h4 class="font-serif font-bold text-base text-[var(--text-primary)]">Aarav &amp; Ananya</h4>
                            <span class="text-[11px] text-[var(--text-muted)]">Houston &bull; Married Mar 2026</span>
                        </div>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] italic leading-relaxed">
                        &ldquo;The single pass model respects marriage as a sacred destination rather than a business subscription.&rdquo;
                    </p>
                </div>

            </div>
        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 5. 1-CLICK DEMO PERSONA SWITCHER                          -->
    <!-- Sample roles for quick evaluation without credentials      -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-ledger p-6 space-y-4 bg-[var(--bg-surface)]">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2 border-b border-[var(--border-subtle)]">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[var(--secondary-text)] block">Quick Review</span>
                    <h3 class="text-lg font-bold font-serif text-[var(--text-primary)]">Explore With Sample Roles</h3>
                </div>
                <p class="text-xs text-[var(--text-muted)]">Click any persona to inspect portals immediately.</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] hover:border-[var(--accent-primary)] border border-[var(--border-default)] transition group">
                    <span class="font-bold text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] block">Dr. Arun (Groom)</span>
                    <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">30 yrs &bull; Physician</span>
                </a>
                <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] hover:border-[var(--secondary-primary)] border border-[var(--border-default)] transition group">
                    <span class="font-bold text-[var(--text-primary)] group-hover:text-[var(--secondary-text)] block">Priya (Bride)</span>
                    <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">26 yrs &bull; Teacher</span>
                </a>
                <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] hover:border-[var(--text-primary)] border border-[var(--border-default)] transition group">
                    <span class="font-bold text-[var(--text-primary)] block">Subhash (Elder)</span>
                    <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">Family Guardian</span>
                </a>
                <a href="{{ route('demo.login', ['email' => 'pandit@globalsaptapadi.com']) }}" class="p-3 rounded-[var(--radius-sm)] bg-[var(--bg-canvas)] hover:border-[var(--accent-hover)] border border-[var(--border-default)] transition group">
                    <span class="font-bold text-[var(--text-primary)] group-hover:text-[var(--accent-primary)] block">Pandit Kalyan</span>
                    <span class="text-[11px] text-[var(--text-muted)] block mt-0.5">Vedic Astrologer</span>
                </a>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 6. CLOSING CTA BAND (STRICT SPEC)                         -->
    <!-- Deep Maroon, Saffron Alpona Corner, White Heading,        -->
    <!-- 3 Trust Chips, Saffron Primary + Transparent Secondary   -->
    <!-- Reduced vertical padding (~25%), NO GAP to footer!        -->
    <!-- ========================================================= -->
    <div id="pricing" class="w-full section--dark relative overflow-hidden py-10 sm:py-12 border-t border-[var(--color-accent)]/30">
        
        <!-- Saffron Alpona Line Pattern (6% opacity in corner) -->
        <div class="pointer-events-none absolute right-0 bottom-0 w-64 h-64 opacity-[0.06] text-[var(--color-accent)]" aria-hidden="true">
            <svg viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="200" cy="200" r="160" stroke-dasharray="6 8"/>
                <circle cx="200" cy="200" r="110"/>
                <circle cx="200" cy="200" r="60" stroke-dasharray="3 4"/>
                <path d="M200 40 L200 200 M40 200 L200 200"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
            
            <div class="max-w-2xl mx-auto space-y-2">
                <h2 class="text-3xl sm:text-4xl font-bold font-serif text-white tracking-tight">
                    Begin your sacred seven steps today.
                </h2>
                <p class="text-base text-[#F3E4DD] max-w-lg mx-auto">
                    A respectful matrimonial sanctuary for Hindu seekers and families worldwide.
                </p>
            </div>

            <!-- 3 Trust Chips -->
            <div class="flex flex-wrap items-center justify-center gap-3 text-xs font-semibold text-[#F3E4DD]">
                <span class="px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-xs">
                    ✓ 100% ID Verified
                </span>
                <span class="px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-xs">
                    ✓ Strict Zero Dowry
                </span>
                <span class="px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-xs">
                    ✓ Single Vivah Pass ($29 USD)
                </span>
            </div>

            <!-- Primary Saffron + Transparent Secondary Buttons -->
            <div class="pt-2 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="btn-saffron !h-[48px] !px-8 !text-[15px] font-semibold">
                    Create free profile
                </a>
                <a href="#how-it-works" class="btn-secondary !h-[48px] !px-6 !text-[15px] font-semibold">
                    Explore how it works
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
