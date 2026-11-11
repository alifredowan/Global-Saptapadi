@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="section--dark relative rounded-2xl p-6 sm:p-8 text-white text-center overflow-hidden border border-[var(--color-accent)]/30 shadow-sm">
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white text-xs font-semibold tracking-wide mb-3">
            <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
            <span>The Seventh Step &bull; Saptapadi Milestone</span>
        </div>
        <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">
            Shubho Bibaho Marriage Declaration
        </h1>
        <p class="text-xs sm:text-sm text-[#F3E4DD] mt-2 max-w-xl mx-auto leading-relaxed">
            Record your wedding solemnization, receive your commemorative certificate, and conclude your matrimonial search.
        </p>
    </div>

    <!-- Active Confirmed Milestone (if already declared) -->
    @if($milestone)
    <!-- Gentle Petal Fall Celebration Overlay (restrained, CSS-only, respects prefers-reduced-motion) -->
    <div class="pointer-events-none fixed inset-0 overflow-hidden z-40 aria-hidden" aria-hidden="true">
        <style>
            @keyframes petalDrift {
                0% { transform: translateY(-10vh) rotate(0deg) translateX(0); opacity: 0; }
                15% { opacity: 0.75; }
                85% { opacity: 0.75; }
                100% { transform: translateY(105vh) rotate(360deg) translateX(40px); opacity: 0; }
            }
            .petal {
                position: absolute;
                top: -5vh;
                width: 14px;
                height: 18px;
                background: linear-gradient(135deg, var(--color-haldi) 0%, var(--color-accent) 100%);
                border-radius: 50% 0 50% 50%;
                opacity: 0;
                animation: petalDrift 7s ease-in-out forwards;
            }
            .petal:nth-child(2) { left: 15%; width: 12px; height: 16px; background: var(--color-primary); animation-duration: 6.5s; animation-delay: 0.4s; }
            .petal:nth-child(3) { left: 30%; width: 16px; height: 20px; background: var(--color-haldi); animation-duration: 8s; animation-delay: 1.1s; }
            .petal:nth-child(4) { left: 48%; width: 13px; height: 17px; background: var(--color-accent); animation-duration: 7.2s; animation-delay: 0.7s; }
            .petal:nth-child(5) { left: 65%; width: 15px; height: 19px; background: var(--color-primary); animation-duration: 6.8s; animation-delay: 1.5s; }
            .petal:nth-child(6) { left: 82%; width: 11px; height: 15px; background: var(--color-haldi); animation-duration: 7.5s; animation-delay: 0.2s; }
            .petal:nth-child(7) { left: 92%; width: 14px; height: 18px; background: var(--color-haldi); animation-duration: 8.2s; animation-delay: 1.8s; }
            @media (prefers-reduced-motion: reduce) {
                .petal { display: none !important; }
            }
        </style>
        <div class="petal" style="left: 8%;"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
        <div class="petal"></div>
    </div>

    <div class="bg-white dark:bg-stone-900 rounded-2xl p-8 border-2 border-[var(--color-accent)]/40 shadow-sm text-center space-y-4">
        <div class="w-14 h-14 mx-auto rounded-full bg-[var(--color-haldi-soft)] text-[var(--color-primary)] dark:text-[var(--color-accent)] flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
        </div>
        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-[var(--color-tulsi)] bg-[var(--color-tulsi)]/10 px-3 py-1 rounded-full border border-[var(--color-tulsi)]/30">
            <svg class="w-3.5 h-3.5 text-[var(--color-tulsi)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            <span>Shubho Bibaho Solemnized</span>
        </span>
        <h2 class="font-serif font-bold text-2xl text-stone-900 dark:text-stone-100">Sacred Matrimonial Union Confirmed</h2>
        <p class="text-sm text-stone-700 dark:text-stone-300 max-w-md mx-auto">
            Sacred union registered between <strong>{{ $milestone->spouseA->name }}</strong> and <strong>{{ $milestone->spouseB->name }}</strong>.
        </p>
        <p class="text-xs text-stone-500 dark:text-stone-400">
            Wedding Solemnized on {{ $milestone->wedding_date->format('d F, Y') }}
        </p>

        <div class="pt-4 flex justify-center space-x-4">
            <a href="{{ route('milestone.certificate', $milestone->certificate_uuid) }}" target="_blank" class="px-6 py-2.5 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white text-xs font-medium transition inline-flex items-center space-x-2 shadow-xs cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                <span>View &amp; Print Commemorative Certificate</span>
            </a>
        </div>
    </div>
    @else
    <!-- Marriage Declaration Form -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-6">
        <div>
            <h2 class="font-serif font-bold text-xl text-stone-900 dark:text-stone-100 flex items-center space-x-2">
                <span>Declare Your Completed Vivah Union</span>
            </h2>
            <p class="text-xs text-stone-600 dark:text-stone-400 mt-1 leading-relaxed">
                Declaring your marriage issues your commemorative certificate, marks your status as <strong>Married</strong>, and closes open proposals so your family's search concludes quietly and with dignity.
            </p>
        </div>

        <form method="POST" action="{{ route('milestone.declare') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">Select Spouse</label>
                    <select name="spouse_id" required class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]">
                        <option value="">Select Spouse from Accepted Proposals</option>
                        @foreach($eligibleSpouses as $spouse)
                        <option value="{{ $spouse->id }}">{{ $spouse->name }} ({{ $spouse->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">Wedding Solemnization Date</label>
                    <input type="date" name="wedding_date" required value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]">
                </div>
            </div>

            <div>
                <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">Voluntary Story (2&ndash;3 sentences)</label>
                <textarea name="success_story" rows="3" placeholder="Share a few words on how your families met and aligned on values..." class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]"></textarea>
            </div>

            <div>
                <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">Wedding Photograph (Voluntary)</label>
                <input type="file" name="wedding_photo" accept="image/*" class="w-full text-xs text-stone-600 dark:text-stone-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-medium file:bg-stone-100 dark:file:bg-stone-800 file:text-stone-800 dark:file:text-stone-200 hover:file:bg-stone-200">
            </div>

            <div class="p-3.5 rounded-xl bg-[var(--color-haldi-soft)]/70 dark:bg-amber-950/20 border border-[var(--color-haldi)]/40 text-stone-800 dark:text-stone-300 text-xs">
                <label class="flex items-start space-x-2.5 cursor-pointer">
                    <input type="checkbox" name="publish_story" value="1" class="mt-0.5 rounded text-[var(--color-primary)] focus:ring-[var(--color-primary)]" checked>
                    <span>Allow publication of our story and photo in the community Shubho Bibaho showcase.</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white font-medium text-xs shadow-xs transition cursor-pointer">
                Solemnize Vivah &amp; Generate Commemorative Certificate
            </button>
        </form>
    </div>
    @endif

    <!-- Structured Community Success Stories ("Shubho Bibaho") -->
    <div class="pt-4 space-y-4">
        <div class="text-center max-w-xl mx-auto">
            <span class="text-[11px] font-bold text-[var(--color-accent)] uppercase tracking-wider block mb-1">Shubho Bibaho</span>
            <h2 class="font-serif font-bold text-2xl text-stone-900 dark:text-stone-100">Recent Family Unions</h2>
            <p class="text-xs text-stone-600 dark:text-stone-400 mt-1">
                Real couples and families who aligned on values, horoscope, and shared aspirations.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 overflow-x-auto pb-2">
            <!-- Story 1 -->
            <div class="bg-white dark:bg-stone-900 rounded-2xl p-5 border border-stone-200/90 dark:border-stone-800 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="aspect-4/3 rounded-xl bg-stone-100 dark:bg-stone-800 overflow-hidden mb-4 relative flex items-center justify-center text-stone-400">
                        <span class="text-xs font-serif font-bold text-[var(--accent-primary)]">London &bull; UK</span>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                        <span>London, UK</span>
                        <span>12 Dec 2025</span>
                    </div>
                    <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Rohan &amp; Meera</h3>
                    <p class="text-xs text-stone-600 dark:text-stone-400 mt-2 leading-relaxed">
                        "Our fathers connected through the family console. The Ashtakoota compatibility and transparent Gotra alignment gave both families complete peace of mind."
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-stone-100 dark:border-stone-800 text-[11px] text-stone-400">
                    Shandilya &bull; Bharadwaj Gotra
                </div>
            </div>

            <!-- Story 2 -->
            <div class="bg-white dark:bg-stone-900 rounded-2xl p-5 border border-stone-200/90 dark:border-stone-800 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="aspect-4/3 rounded-xl bg-stone-100 dark:bg-stone-800 overflow-hidden mb-4 relative flex items-center justify-center text-stone-400">
                        <span class="text-xs font-serif font-bold text-[var(--secondary-text)]">Toronto &bull; Canada</span>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                        <span>Toronto, Canada</span>
                        <span>18 Jan 2026</span>
                    </div>
                    <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Arjun &amp; Priya</h3>
                    <p class="text-xs text-stone-600 dark:text-stone-400 mt-2 leading-relaxed">
                        "We appreciated that phone numbers remained private until both families agreed to talk. The single pass model was fair and dignified."
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-stone-100 dark:border-stone-800 text-[11px] text-stone-400">
                    Kashyapa &bull; Vatsa Gotra
                </div>
            </div>

            <!-- Story 3 -->
            <div class="bg-white dark:bg-stone-900 rounded-2xl p-5 border border-stone-200/90 dark:border-stone-800 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="aspect-4/3 rounded-xl bg-stone-100 dark:bg-stone-800 overflow-hidden mb-4 relative flex items-center justify-center text-stone-400">
                        <span class="text-xs font-serif font-bold text-emerald-700">Houston &bull; USA</span>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                        <span>Houston, USA</span>
                        <span>24 Feb 2026</span>
                    </div>
                    <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Aarav &amp; Ananya</h3>
                    <p class="text-xs text-stone-600 dark:text-stone-400 mt-2 leading-relaxed">
                        "Living abroad, finding someone who genuinely valued our heritage was rare. Global Saptapadi brought our families together with complete cultural transparency."
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-stone-100 dark:border-stone-800 text-[11px] text-stone-400">
                    Gautam &bull; Parashara Gotra
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
