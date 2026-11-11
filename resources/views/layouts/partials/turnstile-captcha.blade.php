@if(config('services.turnstile.key'))
    <!-- Real Cloudflare Turnstile Verification Widget (Production / Cloudflare API) -->
    <div class="w-full flex flex-col items-center py-1">
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
        <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.key') }}" data-theme="dark"></div>
    </div>
@else
    <!-- Cloudflare Turnstile Verification Widget (Interactive Simulation) -->
    <div x-data="{
        verified: false,
        verifying: false,
        errorMessage: '',
        verifyCaptcha() {
            if (!this.verified && !this.verifying) {
                this.verifying = true;
                this.errorMessage = '';
                setTimeout(() => {
                    this.verifying = false;
                    this.verified = true;
                }, 600);
            }
        }
    }" 
    x-init="
        const form = $el.closest('form');
        if (form) {
            form.addEventListener('submit', (e) => {
                if (!verified) {
                    e.preventDefault();
                    e.stopPropagation();
                    errorMessage = 'Please verify that you are human before proceeding.';
                }
            });
        }
    "
    class="w-full">
        <!-- Cloudflare Turnstile Card Container -->
        <div :class="errorMessage ? 'border-rose-500/80 ring-1 ring-rose-500/50' : 'border-[#383838]'"
             class="w-full bg-[#242424] text-white rounded-xl p-3 sm:p-3.5 border shadow-sm flex items-center justify-between transition-all select-none">
            
            <!-- Left: Status & Checkmark / Interactive Trigger -->
            <div class="flex items-center space-x-3">
                <template x-if="verified">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-6 h-6 rounded-full bg-[var(--color-tulsi)] flex items-center justify-center text-white text-xs font-bold shadow-xs">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-white tracking-tight">Success!</span>
                    </div>
                </template>

                <template x-if="verifying">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-6 h-6 rounded-full border-2 border-amber-400 border-t-transparent animate-spin"></div>
                        <span class="text-xs text-stone-300">Verifying you are human...</span>
                    </div>
                </template>

                <template x-if="!verified && !verifying">
                    <button type="button" @click="verifyCaptcha()" class="flex items-center space-x-2.5 cursor-pointer group text-left">
                        <div class="w-6 h-6 rounded-md border-2 border-[#666] group-hover:border-amber-400 bg-[#333] transition flex items-center justify-center"></div>
                        <span class="text-xs text-stone-300 group-hover:text-white transition">Verify you are human</span>
                    </button>
                </template>

                <!-- Hidden token input for automated/backend validation -->
                <input type="hidden" name="cf-turnstile-response" :value="verified ? 'cf-verified-turnstile-token' : ''">
            </div>

            <!-- Right: Cloudflare Logo & Policy Links -->
            <div class="flex flex-col items-end text-right pl-3 shrink-0">
                <div class="flex items-center space-x-1.5">
                    <!-- Cloudflare Authentic Cloud SVG -->
                    <svg class="h-4 w-6" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M64.6 21.2C63.4 13.3 56.5 7.3 48.2 7.3c-7.4 0-13.6 4.9-15.6 11.7-1.4-.6-3-.9-4.6-.9-5.9 0-10.8 4.8-10.8 10.7 0 .7.1 1.4.3 2.1C8.2 31.6 0 39.5 0 49.3c0 .3 0 .7.1 1h78.8c6.2 0 11.2-5 11.2-11.2 0-5.7-4.3-10.4-9.9-11-.3-2-.8-4-1.7-5.7l-13.9-.2z" fill="#F38020"/>
                        <path d="M77.8 28.1c-.3-2-.8-4-1.7-5.7l-11.5-.2c1.2 7.9-5.7 13.9-13.9 13.9h-2.5c-.7 0-1.3.6-1.3 1.3v5.1c0 .7.6 1.3 1.3 1.3h2.5c11.5 0 21.3-7.5 24.6-18.1l2.5 2.4z" fill="#FAAE40"/>
                    </svg>
                    <span class="text-[10px] font-black tracking-widest text-stone-200 uppercase font-sans">CLOUDFLARE</span>
                </div>
                <div class="text-[9px] text-stone-400 space-x-1 mt-0.5">
                    <a href="https://www.cloudflare.com/privacypolicy/" target="_blank" rel="noopener noreferrer" class="hover:text-stone-200 underline">Privacy</a>
                    <span>•</span>
                    <a href="https://support.cloudflare.com/" target="_blank" rel="noopener noreferrer" class="hover:text-stone-200 underline">Help</a>
                </div>
            </div>

        </div>

        <!-- Inline Error Feedback -->
        <template x-if="errorMessage">
            <p class="text-[11px] text-rose-500 font-medium mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-rose-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span x-text="errorMessage"></span>
            </p>
        </template>
    </div>
@endif

