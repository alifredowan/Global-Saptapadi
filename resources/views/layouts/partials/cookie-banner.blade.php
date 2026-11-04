<!-- Cookie Consent Banner (Nikah Style) -->
<div x-data="{
    showBanner: false,
    init() {
        try {
            if (!localStorage.getItem('vivah_cookie_consent')) {
                setTimeout(() => { this.showBanner = true; }, 300);
            }
        } catch (e) {
            this.showBanner = true;
        }
    },
    acceptAll() {
        try { localStorage.setItem('vivah_cookie_consent', 'all'); } catch (e) {}
        this.showBanner = false;
    },
    essentialOnly() {
        try { localStorage.setItem('vivah_cookie_consent', 'essential'); } catch (e) {}
        this.showBanner = false;
    }
}"
x-show="showBanner"
x-cloak
x-transition:enter="transition ease-out duration-300 transform"
x-transition:enter-start="opacity-0 translate-y-6 scale-95"
x-transition:enter-end="opacity-100 translate-y-0 scale-100"
x-transition:leave="transition ease-in duration-200 transform"
x-transition:leave-start="opacity-100 translate-y-0 scale-100"
x-transition:leave-end="opacity-0 translate-y-6 scale-95"
class="fixed bottom-4 left-4 sm:bottom-6 sm:left-6 z-40 max-w-md w-[calc(100vw-2rem)] sm:w-[420px] bg-white/95 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-stone-200 shadow-2xl shadow-stone-900/15">
    
    <div class="flex items-start space-x-3.5">
        <!-- Cookie Emoji Icon Badge -->
        <div class="w-10 h-10 rounded-2xl bg-amber-50 border border-amber-200/90 flex items-center justify-center text-xl shrink-0 shadow-xs">
            <span>🍪</span>
        </div>

        <div class="flex-1 space-y-1">
            <!-- Title -->
            <div class="flex items-center justify-between">
                <h4 class="font-heading font-bold text-sm text-stone-900 tracking-tight">
                    Your privacy, your choice
                </h4>
                <button type="button" @click="essentialOnly()" class="text-stone-400 hover:text-stone-600 text-xs p-1 transition" title="Dismiss">
                    ✕
                </button>
            </div>

            <!-- Description -->
            <p class="text-[12px] sm:text-xs text-stone-600 leading-relaxed">
                We use essential cookies to keep you signed in, protect forms, and remember your privacy preference. We do not use advertising cookies. 
                <a href="{{ route('about') }}#legal-compliance" class="font-semibold text-amber-900 underline hover:text-red-900 transition">
                    Read our cookie policy
                </a>.
            </p>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between gap-2 pt-3 mt-1">
                <div class="flex items-center gap-2">
                    <button type="button" 
                            @click="acceptAll()" 
                            class="px-4 py-2 rounded-xl gold-gradient text-white text-xs font-bold hover:opacity-95 shadow-xs transition cursor-pointer">
                        Accept all
                    </button>

                    <button type="button" 
                            @click="essentialOnly()" 
                            class="px-3.5 py-2 rounded-xl border border-stone-300 text-stone-700 bg-white hover:bg-stone-50 text-xs font-bold transition cursor-pointer">
                        Essential only
                    </button>
                </div>

                <a href="{{ route('about') }}#legal-compliance" class="text-xs text-stone-500 hover:text-stone-800 font-medium transition shrink-0">
                    Questions?
                </a>
            </div>
        </div>
    </div>
</div>

