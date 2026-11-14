@extends('layouts.app')

@section('content')
<div class="space-y-16 sm:space-y-24 pt-4 sm:pt-8 pb-0">

    <!-- ========================================================= -->
    <!-- 1. HERO: THE SACRED HEARTH & HEIRLOOM INVITATION          -->
    <!-- Poetic clarity, no banned kickers, authentic heirloom folio -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="heirloom-folio relative overflow-hidden rounded-[var(--radius-lg)] p-8 sm:p-12 lg:p-16 bg-[var(--bg-surface)]">
            
            <!-- Delicate Alpona Corner Flourishes -->
            <svg class="corner-ornament corner-ornament-tl" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                <path d="M2 2v10a10 10 0 0 0 10 10h10M2 2h10a10 10 0 0 1 10 10v10M6 2v6a6 6 0 0 0 6 6h6"/>
            </svg>
            <svg class="corner-ornament corner-ornament-tr" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                <path d="M2 2v10a10 10 0 0 0 10 10h10M2 2h10a10 10 0 0 1 10 10v10M6 2v6a6 6 0 0 0 6 6h6"/>
            </svg>
            <svg class="corner-ornament corner-ornament-bl" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                <path d="M2 2v10a10 10 0 0 0 10 10h10M2 2h10a10 10 0 0 1 10 10v10M6 2v6a6 6 0 0 0 6 6h6"/>
            </svg>
            <svg class="corner-ornament corner-ornament-br" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                <path d="M2 2v10a10 10 0 0 0 10 10h10M2 2h10a10 10 0 0 1 10 10v10M6 2v6a6 6 0 0 0 6 6h6"/>
            </svg>

            <!-- Background Traditional Mandala Watermark -->
            <div class="absolute -top-16 -right-16 pointer-events-none opacity-[0.04] text-[var(--color-primary)] hidden md:block" aria-hidden="true">
                <svg width="420" height="420" viewBox="0 0 400 400" fill="none" stroke="currentColor" stroke-width="1.2">
                    <circle cx="200" cy="200" r="180" stroke-dasharray="6 8"/>
                    <circle cx="200" cy="200" r="140"/>
                    <circle cx="200" cy="200" r="100" stroke-dasharray="4 4"/>
                    <circle cx="200" cy="200" r="60"/>
                    <circle cx="200" cy="200" r="20"/>
                    <path d="M200 20 L200 380 M20 200 L380 200 M72 72 L328 328 M72 328 L328 72"/>
                </svg>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center relative z-10">
                
                <!-- Left Editorial Column (7 cols) -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <h1 class="font-serif font-bold text-3xl sm:text-5xl lg:text-[3.5rem] text-[var(--text-primary)] tracking-tight leading-[1.12]">
                        Seven sacred steps around the holy fire. One lifelong union.
                    </h1>

                    <p class="text-lg sm:text-xl text-[var(--text-secondary)] leading-relaxed max-w-xl font-normal">
                        A reverent matrimonial home for intentional Hindu seekers and families across the diaspora. Honoring Vedic lineage, genuine privacy, and elder blessing without the noise of swipe culture.
                    </p>

                    <!-- Primary Action Row -->
                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="{{ route('register') }}" class="btn-primary !h-[52px] !px-8 !text-[16px] font-semibold">
                            <span>Begin sacred journey</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                        <a href="#saptapadi-path" class="btn-secondary !h-[52px] !px-6 !text-[16px] font-medium">
                            Explore the Seven Vows
                        </a>
                    </div>

                    <!-- Authentic Lineage & Trust Stamp -->
                    <div class="pt-4 border-t border-[var(--border-subtle)] flex flex-wrap items-center gap-6 text-xs text-[var(--text-secondary)]">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[var(--color-tulsi)]"></span>
                            <span class="font-medium">100% ID &amp; Lineage Verified</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[var(--color-accent)]"></span>
                            <span class="font-medium">Veiled Portraits Until Consent</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[var(--color-primary)]"></span>
                            <span class="font-medium">Elder &amp; Pandit Collaboration</span>
                        </div>
                    </div>

                </div>

                <!-- Right Sanctuary Preview Folio (5 cols) -->
                <div class="lg:col-span-5">
                    <div class="relative bg-[var(--color-bg)] rounded-[var(--radius-md)] border border-[var(--border-strong)] p-6 sm:p-7 shadow-sm space-y-5">
                        
                        <!-- Top Folio Header -->
                        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-default)]">
                            <div>
                                <h2 class="font-serif font-bold text-lg text-[var(--color-primary)]">
                                    Sampark Patrika
                                </h2>
                                <p class="text-[11px] text-[var(--text-muted)]">Verified Candidate Dossier</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-[var(--radius-xs)] bg-[var(--color-tulsi-soft)] border border-[var(--color-tulsi-border)] text-[var(--color-tulsi)] text-[11px] font-bold">
                                32 / 36 Guna Milan
                            </span>
                        </div>

                        <!-- Biodata Content with Silk-Veiled Portrait -->
                        <div class="flex items-start gap-4">
                            <!-- Veiled Portrait Representation -->
                            <div class="relative w-20 h-24 rounded-[var(--radius-sm)] border border-[var(--border-default)] overflow-hidden shrink-0">
                                <div class="w-full h-full bg-stone-200 flex items-center justify-center font-serif text-sm font-bold text-[var(--color-primary)]">
                                    AI
                                </div>
                                <div class="silk-veil absolute inset-0 flex flex-col items-center justify-center p-1 text-center">
                                    <svg class="w-4 h-4 text-[var(--color-accent)] mb-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                                    </svg>
                                    <span class="text-[9px] font-semibold text-[var(--color-ink-darker)] uppercase tracking-tight">Veiled</span>
                                </div>
                            </div>

                            <!-- Candidate Details -->
                            <div class="min-w-0 space-y-1">
                                <div class="flex items-center gap-1.5">
                                    <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">
                                        Ananya Iyer
                                    </h3>
                                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-tulsi)]" title="Government ID Verified"></span>
                                </div>
                                <p class="text-xs text-[var(--text-secondary)] font-medium">
                                    28 yrs &bull; Toronto, Canada
                                </p>
                                <p class="text-[12px] text-[var(--text-secondary)]">
                                    Urban Architect &bull; B.Arch (U of T)
                                </p>
                                <p class="text-[11px] text-[var(--color-primary)] font-medium pt-1">
                                    Gotra: Kasyapa &bull; Rohini Nakshatra
                                </p>
                            </div>
                        </div>

                        <!-- Biodata Narrative Snippet -->
                        <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-surface)] border border-[var(--border-subtle)] text-xs text-[var(--text-secondary)] leading-relaxed italic">
                            &ldquo;Looking for an intentional companion who values classical Carnatic arts, quiet Sunday morning trail walks, and family dinners.&rdquo;
                        </div>

                        <!-- Discovery Direct Action -->
                        <div class="pt-1">
                            <a href="{{ route('discovery.index') }}" class="btn-primary w-full !min-h-[44px] !h-[44px] !text-xs font-semibold">
                                Explore Verified Diaspora Profiles
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 2. THE SAPTAPADI WALK: SEVEN SACRED STEPS AROUND AGNI      -->
    <!-- Experiential ceremonial pathway, authentic Vedic vows     -->
    <!-- ========================================================= -->
    <div id="saptapadi-path" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="space-y-12">
            
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <h2 class="font-serif font-bold text-3xl sm:text-4xl text-[var(--text-primary)] tracking-tight">
                    The Seven Sacred Vows of the Saptapadi
                </h2>
                <p class="text-base text-[var(--text-secondary)] leading-relaxed">
                    In Vedic matrimony, the couple circumambulates the sacred Agni fire seven times. Each step is an eternal covenant witnessed by elders, elements, and dharma.
                </p>
            </div>

            <!-- Authentic Sacred Vows Path Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-4">
                
                <!-- Step 1 -->
                <div class="heirloom-folio rounded-[var(--radius-md)] p-5 space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-primary)]/20 text-[var(--color-primary)] font-serif font-bold text-sm flex items-center justify-center">
                            I
                        </div>
                        <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">
                            Nourishment
                        </h3>
                        <p class="text-[12px] text-[var(--color-accent)] font-serif italic">
                            Ekamisham Vishnuranvetu
                        </p>
                        <p class="text-xs text-[var(--text-secondary)] leading-normal">
                            To honor and nourish one another with pure food, physical health, and harmonious home life.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[var(--border-subtle)] text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">
                        Step 1: Bio-Data
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="heirloom-folio rounded-[var(--radius-md)] p-5 space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-primary)]/20 text-[var(--color-primary)] font-serif font-bold text-sm flex items-center justify-center">
                            II
                        </div>
                        <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">
                            Vital Strength
                        </h3>
                        <p class="text-[12px] text-[var(--color-accent)] font-serif italic">
                            Dve Oorje Vishnuranvetu
                        </p>
                        <p class="text-xs text-[var(--text-secondary)] leading-normal">
                            To cultivate mental, emotional, and spiritual fortitude to navigate life together.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[var(--border-subtle)] text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">
                        Step 2: ID Check
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="heirloom-folio rounded-[var(--radius-md)] p-5 space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-primary)]/20 text-[var(--color-primary)] font-serif font-bold text-sm flex items-center justify-center">
                            III
                        </div>
                        <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">
                            Dharma &amp; Wealth
                        </h3>
                        <p class="text-[12px] text-[var(--color-accent)] font-serif italic">
                            Treeni Rayasposhaya
                        </p>
                        <p class="text-xs text-[var(--text-secondary)] leading-normal">
                            To build righteous wealth, practice honest stewardship, and support community welfare.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[var(--border-subtle)] text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">
                        Step 3: Kundali
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="heirloom-folio rounded-[var(--radius-md)] p-5 space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-primary)]/20 text-[var(--color-primary)] font-serif font-bold text-sm flex items-center justify-center">
                            IV
                        </div>
                        <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">
                            Mutual Joy
                        </h3>
                        <p class="text-[12px] text-[var(--color-accent)] font-serif italic">
                            Chatwari Mayobhavaya
                        </p>
                        <p class="text-xs text-[var(--text-secondary)] leading-normal">
                            To foster deep affection, laughter, companionship, and shared domestic happiness.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[var(--border-subtle)] text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">
                        Step 4: Mutual Interest
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="heirloom-folio rounded-[var(--radius-md)] p-5 space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-primary)]/20 text-[var(--color-primary)] font-serif font-bold text-sm flex items-center justify-center">
                            V
                        </div>
                        <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">
                            Family Lineage
                        </h3>
                        <p class="text-[12px] text-[var(--color-accent)] font-serif italic">
                            Pancha Pashubhyo
                        </p>
                        <p class="text-xs text-[var(--text-secondary)] leading-normal">
                            To pray for noble offspring, nurture future generations, and honor ancestors with reverence.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[var(--border-subtle)] text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">
                        Step 5: Elder Seat
                    </div>
                </div>

                <!-- Step 6 -->
                <div class="heirloom-folio rounded-[var(--radius-md)] p-5 space-y-3 flex flex-col justify-between">
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-[var(--color-primary-soft)] border border-[var(--color-primary)]/20 text-[var(--color-primary)] font-serif font-bold text-sm flex items-center justify-center">
                            VI
                        </div>
                        <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">
                            All Seasons
                        </h3>
                        <p class="text-[12px] text-[var(--color-accent)] font-serif italic">
                            Shad Ritubhyo
                        </p>
                        <p class="text-xs text-[var(--text-secondary)] leading-normal">
                            To remain united across the six seasons of life through trials, change, and celebration.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[var(--border-subtle)] text-[10px] font-semibold text-[var(--text-muted)] uppercase tracking-wider">
                        Step 6: Sanctuary Chat
                    </div>
                </div>

                <!-- Step 7 -->
                <div class="heirloom-folio rounded-[var(--radius-md)] p-5 space-y-3 flex flex-col justify-between border-[var(--color-accent)] bg-[var(--color-accent-soft)]/20">
                    <div class="space-y-2">
                        <div class="w-8 h-8 rounded-full bg-[var(--color-accent)] text-[var(--color-ink-darker)] font-serif font-bold text-sm flex items-center justify-center">
                            VII
                        </div>
                        <h3 class="font-serif font-bold text-base text-[var(--color-ink-darker)]">
                            Eternal Bond
                        </h3>
                        <p class="text-[12px] text-[var(--color-primary)] font-serif italic">
                            Sakha Saptapada Bhava
                        </p>
                        <p class="text-xs text-[var(--color-ink-darker)] leading-normal">
                            &ldquo;With seven steps, you have become my lifelong friend. May we never separate.&rdquo;
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[var(--color-accent)]/30 text-[10px] font-bold text-[var(--color-accent-hover)] uppercase tracking-wider">
                        Step 7: Shubho Vivah
                    </div>
                </div>

            </div>

        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 3. SANCTUARY PILLARS: WHY SAPTAPADI IS MEANINGFULLY DIFFERENT -->
    <!-- Asymmetric, narrative-led, no repetitive card clones       -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="space-y-12">
            
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <h2 class="font-serif font-bold text-3xl sm:text-4xl text-[var(--text-primary)] tracking-tight">
                    Sacred Principles of the Sanctuary
                </h2>
                <p class="text-base text-[var(--text-secondary)] leading-relaxed">
                    Designed from the ground up to eliminate commercial matrimony traps, protect personal dignity, and honor family tradition.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Pillar 1: Photo Veil -->
                <div class="heirloom-folio rounded-[var(--radius-lg)] p-8 space-y-4">
                    <div class="w-12 h-12 rounded-[var(--radius-sm)] bg-[var(--color-primary-soft)] text-[var(--color-primary)] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-[var(--text-primary)]">
                        The Veil of Discretion (Private Portraits)
                    </h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed">
                        Public catalog browsing reduces human beings to commodities. On Global Saptapadi, portraits remain softly veiled until both candidates and their guardians mutually agree to connect. Your photos never leak onto search engines or unauthorized scrapers.
                    </p>
                </div>

                <!-- Pillar 2: 36-Guna Ashtakoota -->
                <div class="heirloom-folio rounded-[var(--radius-lg)] p-8 space-y-4">
                    <div class="w-12 h-12 rounded-[var(--radius-sm)] bg-[var(--color-accent-soft)] text-[var(--color-accent)] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3a14.5 14.5 0 0 0 0 18M12 3a14.5 14.5 0 0 1 0 18M3 12h18"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-[var(--text-primary)]">
                        36-Point Vedic Harmony (Ashtakoota Milan)
                    </h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed">
                        Mathematical astrological compatibility analysis covering Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi. Includes strict Sagotra protection, optional birth chart consultation, and verified family pandit access without fear-mongering.
                    </p>
                </div>

                <!-- Pillar 3: Dual-Seat Family Hearth -->
                <div class="heirloom-folio rounded-[var(--radius-lg)] p-8 space-y-4">
                    <div class="w-12 h-12 rounded-[var(--radius-sm)] bg-[var(--color-tulsi-soft)] text-[var(--color-tulsi)] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-[var(--text-primary)]">
                        The Dual-Seat Family Hearth
                    </h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed">
                        Parents and candidates participate as coordinated equals. Elders can review biodata dossiers, verify family values, and participate in chaperoned conversations without ever overstepping the seeker's personal autonomy and boundaries.
                    </p>
                </div>

                <!-- Pillar 4: Single Vivah Pass -->
                <div class="heirloom-folio rounded-[var(--radius-lg)] p-8 space-y-4">
                    <div class="w-12 h-12 rounded-[var(--radius-sm)] bg-[var(--color-haldi-soft)] text-[var(--color-ink-darker)] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.001-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-[var(--text-primary)]">
                        The Single Pass Covenant ($29 Once)
                    </h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed">
                        Commercial sites charge monthly recurring subscriptions—meaning they profit the longer you stay single. Global Saptapadi offers a single $29 lifetime pass. When you marry, your pass is joyfully closed under Shubho Bibaho. We only succeed when you succeed.
                    </p>
                </div>

            </div>

        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 4. SHUBHO BIBAHO ARCHIVE: REAL DIASPORA UNIONS           -->
    <!-- Heirloom wedding register format with authentic blessings -->
    <!-- ========================================================= -->
    <div id="success-stories" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="heirloom-folio rounded-[var(--radius-lg)] p-8 sm:p-12 space-y-8 bg-[var(--bg-surface)]">
            
            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-4 pb-4 border-b border-[var(--border-default)]">
                <div>
                    <h2 class="font-serif font-bold text-2xl sm:text-3xl text-[var(--text-primary)]">
                        The Shubho Bibaho Register
                    </h2>
                    <p class="text-sm text-[var(--text-secondary)] mt-1">
                        Archived milestones of families united through intentional discernment.
                    </p>
                </div>
                @auth
                <a href="{{ route('milestone.index') }}" class="text-xs font-semibold text-[var(--color-primary)] hover:underline">
                    Declare Your Milestone &rarr;
                </a>
                @else
                <a href="{{ route('register') }}" class="text-xs font-semibold text-[var(--color-primary)] hover:underline">
                    Begin Your Story &rarr;
                </a>
                @endauth
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Couple 1 -->
                <div class="p-6 rounded-[var(--radius-sm)] bg-[var(--color-bg)] border border-[var(--border-default)] space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[var(--color-primary)] text-white font-serif font-bold flex items-center justify-center text-xs shrink-0">
                            R&amp;M
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">Rohan &amp; Meera</h3>
                            <span class="text-[11px] text-[var(--text-muted)]">London &bull; Married Oct 2025</span>
                        </div>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed italic">
                        &ldquo;Our parents reviewed Kundli matches calmly without awkward sales calls, pressure tactics, or recurring monthly fees. It felt like family sitting together in a living room.&rdquo;
                    </p>
                </div>

                <!-- Couple 2 -->
                <div class="p-6 rounded-[var(--radius-sm)] bg-[var(--color-bg)] border border-[var(--border-default)] space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[var(--color-accent)] text-[var(--color-ink-darker)] font-serif font-bold flex items-center justify-center text-xs shrink-0">
                            A&amp;P
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">Arjun &amp; Priya</h3>
                            <span class="text-[11px] text-[var(--text-muted)]">Toronto &bull; Married Jan 2026</span>
                        </div>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed italic">
                        &ldquo;Photo veil protection gave my family immense peace of mind. Only families with genuine mutual resonance could see portraits, preserving privacy and dignity completely.&rdquo;
                    </p>
                </div>

                <!-- Couple 3 -->
                <div class="p-6 rounded-[var(--radius-sm)] bg-[var(--color-bg)] border border-[var(--border-default)] space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[var(--color-tulsi)] text-white font-serif font-bold flex items-center justify-center text-xs shrink-0">
                            A&amp;A
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-base text-[var(--text-primary)]">Aarav &amp; Ananya</h3>
                            <span class="text-[11px] text-[var(--text-muted)]">Houston &bull; Married Mar 2026</span>
                        </div>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed italic">
                        &ldquo;The single pass model honors marriage as a sacred destination rather than a lingering subscription trap. We found our union with grace and elder blessings.&rdquo;
                    </p>
                </div>

            </div>

        </section>
    </div>

    <!-- ========================================================= -->
    <!-- 5. WALK THROUGH THE SANCTUARY: DEMONSTRATION ROLES        -->
    <!-- Immediate direct exploration of Var, Kanya, Elder & Pandit -->
    <!-- ========================================================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="heirloom-folio rounded-[var(--radius-md)] p-6 sm:p-8 space-y-4 bg-[var(--bg-surface)]">
            
            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2 pb-3 border-b border-[var(--border-subtle)]">
                <div>
                    <h2 class="font-serif font-bold text-xl text-[var(--text-primary)]">
                        Walk Through the Sanctuary Portals
                    </h2>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">
                        Test each distinct seat in the matrimonial circle without entering credentials.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
                
                <!-- Groom -->
                <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="p-4 rounded-[var(--radius-sm)] bg-[var(--color-bg)] hover:border-[var(--color-primary)] border border-[var(--border-default)] transition group">
                    <span class="font-serif font-bold text-sm text-[var(--text-primary)] group-hover:text-[var(--color-primary)] block">Dr. Arun (Groom)</span>
                    <span class="text-[11px] text-[var(--text-secondary)] block mt-1">Var Portal &bull; 30 yrs Physician</span>
                    <span class="text-[10px] text-[var(--color-accent)] font-medium block mt-2">Open Groom Seat &rarr;</span>
                </a>

                <!-- Bride -->
                <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="p-4 rounded-[var(--radius-sm)] bg-[var(--color-bg)] hover:border-[var(--color-accent)] border border-[var(--border-default)] transition group">
                    <span class="font-serif font-bold text-sm text-[var(--text-primary)] group-hover:text-[var(--color-accent)] block">Priya (Bride)</span>
                    <span class="text-[11px] text-[var(--text-secondary)] block mt-1">Kanya Sanctuary &bull; 26 yrs Teacher</span>
                    <span class="text-[10px] text-[var(--color-accent)] font-medium block mt-2">Open Bride Seat &rarr;</span>
                </a>

                <!-- Elder -->
                <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="p-4 rounded-[var(--radius-sm)] bg-[var(--color-bg)] hover:border-[var(--text-primary)] border border-[var(--border-default)] transition group">
                    <span class="font-serif font-bold text-sm text-[var(--text-primary)] block">Subhash (Guardian)</span>
                    <span class="text-[11px] text-[var(--text-secondary)] block mt-1">Elder Console &bull; Family Chaperone</span>
                    <span class="text-[10px] text-[var(--color-accent)] font-medium block mt-2">Open Elder Console &rarr;</span>
                </a>

                <!-- Pandit -->
                <a href="{{ route('demo.login', ['email' => 'pandit@globalsaptapadi.com']) }}" class="p-4 rounded-[var(--radius-sm)] bg-[var(--color-bg)] hover:border-[var(--color-primary)] border border-[var(--border-default)] transition group">
                    <span class="font-serif font-bold text-sm text-[var(--text-primary)] group-hover:text-[var(--color-primary)] block">Pandit Kalyan</span>
                    <span class="text-[11px] text-[var(--text-secondary)] block mt-1">Vedic Astrologer &bull; Patrika Verification</span>
                    <span class="text-[10px] text-[var(--color-accent)] font-medium block mt-2">Open Pandit Console &rarr;</span>
                </a>

            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 6. THE CLOSING HEARTH: SACRED INVITATION & COVENANT        -->
    <!-- Deep ceremonial Kumkum Maroon, gold Alpona geometry        -->
    <!-- ========================================================= -->
    <div id="pricing" class="w-full section--dark relative overflow-hidden py-14 sm:py-20 border-t border-[var(--color-accent)]/30">
        
        <!-- Sacred Alpona Geometric Motif -->
        <div class="pointer-events-none absolute right-0 bottom-0 w-80 h-80 opacity-[0.06] text-[var(--color-accent)]" aria-hidden="true">
            <svg viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.2">
                <circle cx="200" cy="200" r="170" stroke-dasharray="6 8"/>
                <circle cx="200" cy="200" r="130"/>
                <circle cx="200" cy="200" r="90" stroke-dasharray="3 4"/>
                <circle cx="200" cy="200" r="50"/>
                <path d="M200 30 L200 200 M30 200 L200 200 M80 80 L200 200"/>
            </svg>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-8">
            
            <div class="space-y-3">
                <h2 class="text-3xl sm:text-5xl font-bold font-serif text-white tracking-tight">
                    Begin your sacred seven steps today.
                </h2>
                <p class="text-lg text-[#F3E4DD] max-w-xl mx-auto leading-relaxed">
                    A dignified sanctuary where families gather in trust, seekers find authentic resonance, and sacred unions are solemnized for life.
                </p>
            </div>

            <!-- Authentic Trust Guarantees -->
            <div class="flex flex-wrap items-center justify-center gap-4 text-xs font-semibold text-[#F3E4DD]">
                <div class="px-4 py-2 rounded-[var(--radius-sm)] bg-white/10 border border-white/15">
                    100% Verified Identities
                </div>
                <div class="px-4 py-2 rounded-[var(--radius-sm)] bg-white/10 border border-white/15">
                    Strict Zero-Dowry Covenant
                </div>
                <div class="px-4 py-2 rounded-[var(--radius-sm)] bg-white/10 border border-white/15">
                    Single Vivah Pass ($29 USD Once)
                </div>
            </div>

            <!-- Primary Actions -->
            <div class="pt-2 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="btn-saffron !h-[52px] !px-8 !text-[16px] font-semibold">
                    Create Sacred Profile
                </a>
                <a href="#saptapadi-path" class="btn-secondary !h-[52px] !px-6 !text-[16px] font-medium">
                    Review the Seven Vows
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
