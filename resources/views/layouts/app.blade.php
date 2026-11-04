<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Vivah Connect') }} - Sacred Matrimonial Union</title>
    
    <!-- Google Fonts: Cinzel (Auspicious Heading), Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via CDN for instant zero-config styling + font setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        auspicious: {
                            crimson: '#800020',
                            deepred: '#991b1b',
                            saffron: '#ea580c',
                            terracotta: '#c2410c',
                            gold: '#b45309',
                            goldlight: '#fef3c7',
                            cream: '#fdfbf7',
                            sand: '#fbf7ee',
                            card: '#ffffff'
                        }
                    },
                    fontFamily: {
                        heading: ['Cinzel', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js for zero-tab sidebar & 3-dots drawer interaction -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <!-- Laravel Reverb & Echo Real-Time WebSockets -->
    @vite(['resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        html {
            scroll-behavior: smooth;
            -webkit-tap-highlight-color: transparent;
        }
        body {
            background-color: #fcf9f2;
            color: #27272a;
        }
        /* Custom smooth scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #fbf7ee;
        }
        ::-webkit-scrollbar-thumb {
            background: #d4a373;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #b45309;
        }
        .auspicious-border {
            border-image: linear-gradient(to right, #800020, #ea580c, #b45309) 1;
        }
        .gold-gradient {
            background: linear-gradient(135deg, #800020 0%, #991b1b 50%, #c2410c 100%);
        }
        .smooth-card {
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.2s ease;
        }
        .smooth-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px -10px rgba(128, 0, 32, 0.12), 0 4px 8px -2px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="h-full font-sans antialiased bg-[#fcf9f2] text-zinc-800 selection:bg-amber-500 selection:text-white"
      x-data="{
          sidebarOpen: (function() {
              try { return localStorage.getItem('vivah_sidebar_expanded') === 'true'; } catch(e) { return false; }
          })(),
          mobileSidebarOpen: false,
          toggleSidebar() {
              if (window.innerWidth >= 1024) {
                  this.sidebarOpen = !this.sidebarOpen;
                  try { localStorage.setItem('vivah_sidebar_expanded', this.sidebarOpen); } catch(e){}
              } else {
                  this.mobileSidebarOpen = !this.mobileSidebarOpen;
              }
          }
      }">

    @auth
    {{-- ========================================================= --}}
    {{-- AUTHENTICATED USER: FULL SIDEBAR LAYOUT (NO TOP TABS)    --}}
    {{-- ========================================================= --}}
    <div class="min-h-full flex">

        <!-- Mobile Off-Canvas Sidebar Backdrop & Drawer -->
        <div x-show="mobileSidebarOpen"
             x-cloak
             class="fixed inset-0 z-50 lg:hidden flex"
             role="dialog"
             aria-modal="true">
            
            <!-- Backdrop -->
            <div x-show="mobileSidebarOpen"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="mobileSidebarOpen = false"
                 class="fixed inset-0 bg-stone-950/80 backdrop-blur-xs"></div>

            <!-- Mobile Drawer -->
            <div x-show="mobileSidebarOpen"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="relative mr-16 flex-1 w-full max-w-xs bg-gradient-to-b from-stone-950 via-[#1f0709] to-stone-950 border-r border-amber-900/60 text-amber-100 flex flex-col py-5 px-4 shadow-2xl">
                
                <!-- Close Button -->
                <div class="absolute top-4 right-4">
                    <button type="button"
                            @click="mobileSidebarOpen = false"
                            class="p-2 rounded-xl text-amber-400/80 hover:text-white hover:bg-stone-800 focus:outline-none cursor-pointer"
                            title="Close Drawer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Brand in Mobile Drawer -->
                <div @click="mobileSidebarOpen = false" class="flex items-center gap-3 px-2 mb-6 cursor-pointer select-none">
                    <div class="w-10 h-10 rounded-xl gold-gradient flex items-center justify-center text-amber-200 text-xs font-black shadow-md shadow-amber-950/40">
                        VC
                    </div>
                    <div>
                        <span class="font-heading font-bold text-lg text-amber-100 tracking-wider flex items-center gap-1">
                            VIVAH <span class="text-amber-400">CONNECT</span>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400/80 block -mt-0.5">
                            @if(Auth::user()->role === 'family_rep')
                                Family Representative
                            @elseif(Auth::user()->role === 'admin')
                                Platform Administrator
                            @else
                                {{ Auth::user()->gender === 'female' ? 'Kanya Portal' : 'Var Portal' }}
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Navigation Links in Drawer -->
                <nav class="flex-1 overflow-y-auto pr-1">
                    @include('layouts.partials.sidebar-nav')
                </nav>

                <!-- Mobile User Card & Logout -->
                <div class="pt-4 mt-4 border-t border-amber-900/60">
                    <div class="flex items-center gap-2.5 px-2 py-2 rounded-xl bg-stone-900/80 border border-amber-900/40">
                        <div class="w-9 h-9 rounded-full bg-red-900 border border-amber-400 text-amber-200 font-bold flex items-center justify-center text-xs shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-amber-400/80 font-medium capitalize">{{ Auth::user()->role === 'family_rep' ? 'Family Elder' : Auth()->user()->role }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-semibold text-rose-300 hover:bg-rose-950/50 rounded-xl transition cursor-pointer">
                            <span>🚪</span> Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Desktop Collapsible Sidebar -->
        <aside x-show="sidebarOpen"
               x-cloak
               x-transition:enter="transition-all ease-in-out duration-300"
               x-transition:enter-start="opacity-0 -translate-x-full w-0"
               x-transition:enter-end="opacity-100 translate-x-0 w-72"
               x-transition:leave="transition-all ease-in-out duration-300"
               x-transition:leave-start="opacity-100 translate-x-0 w-72"
               x-transition:leave-end="opacity-0 -translate-x-full w-0"
               class="hidden lg:flex lg:flex-col lg:w-72 bg-gradient-to-b from-stone-950 via-[#1f0709] to-stone-950 text-amber-100 border-r border-amber-900/60 shrink-0 sticky top-0 h-screen z-30 transition-all duration-300 shadow-xl overflow-hidden">
            
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-amber-900/60 flex items-center justify-between gap-2 shrink-0">
                <button type="button"
                        @click="toggleSidebar()"
                        class="flex items-center gap-2.5 group flex-1 min-w-0 text-left cursor-pointer focus:outline-none"
                        title="Toggle Navigation Sidebar">
                    <div class="w-9 h-9 rounded-xl gold-gradient flex items-center justify-center text-amber-200 text-xs font-black shadow-md shadow-amber-950/40 group-hover:scale-105 transition transform">
                        VC
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="font-heading font-bold text-base text-amber-100 tracking-wider group-hover:text-amber-300 transition truncate">
                            VIVAH <span class="text-amber-400">CONNECT</span>
                        </div>
                        <div class="text-[9px] uppercase font-semibold text-amber-300/80 truncate">
                            @if(Auth::user()->role === 'family_rep')
                                Family Representative
                            @elseif(Auth::user()->role === 'admin')
                                Platform Administrator
                            @else
                                {{ Auth::user()->gender === 'female' ? 'Kanya Portal' : 'Var Portal' }}
                            @endif
                        </div>
                    </div>
                </button>
                <button type="button"
                        @click="toggleSidebar()"
                        class="p-1.5 rounded-lg text-amber-400/80 hover:text-white hover:bg-stone-800 transition focus:outline-none cursor-pointer"
                        title="Collapse Sidebar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 p-4 overflow-y-auto">
                @include('layouts.partials.sidebar-nav')
            </nav>

            <!-- Sidebar Footer User Card with Integrated Logout -->
            <div class="p-4 border-t border-amber-900/50 bg-stone-950/80 shrink-0">
                <div class="flex items-center justify-between gap-2 p-2.5 rounded-2xl bg-stone-900/90 border border-amber-900/40">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-red-900 border border-amber-400 text-amber-200 font-bold flex items-center justify-center text-xs shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-amber-400/80 truncate capitalize">
                                {{ Auth::user()->role === 'family_rep' ? 'Family Elder' : (Auth::user()->role === 'admin' ? 'Administrator' : 'Seeker') }}
                                @if(Auth::user()->is_verified) • ✓ Verified @endif
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Sign Out" class="p-2 text-stone-400 hover:text-rose-400 hover:bg-stone-800 rounded-xl transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Canvas (Top Header with ZERO TABS + Content) -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#fcf9f2]">

            <!-- Clean Top Navigation Header (NO TABS) -->
            <header class="sticky top-0 z-40 h-16 bg-white border-b border-amber-200 shadow-sm flex items-center justify-between px-4 sm:px-6 lg:px-8" style="background-color: #ffffff !important;">
                <!-- Left: 3-Dots Button AND Vivah Connect Logo (Both trigger open/close) -->
                <div class="flex items-center space-x-3 shrink-0">
                    <!-- 3-Dots Toggle Button (The ONE 3-Dots Button) -->
                    <button type="button"
                            @click="toggleSidebar()"
                            class="p-2.5 rounded-xl text-stone-700 hover:text-red-900 hover:bg-amber-100/70 border border-amber-200/80 shadow-xs transition focus:outline-none cursor-pointer flex items-center justify-center shrink-0"
                            aria-label="Toggle Sidebar Menu"
                            title="Open / Close Sidebar (3 Dots)">
                        <svg class="w-6 h-6 text-red-950" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="5" cy="12" r="2.25"/>
                            <circle cx="12" cy="12" r="2.25"/>
                            <circle cx="19" cy="12" r="2.25"/>
                        </svg>
                    </button>

                    <!-- Vivah Connect Brand Logo & Name (Clicking opens / toggles sidebar) -->
                    <div @click="toggleSidebar()"
                         class="flex items-center space-x-2.5 cursor-pointer select-none group shrink-0 whitespace-nowrap"
                         title="Open / Close Sidebar (Vivah Connect Logo)">
                        <div class="w-9 h-9 rounded-xl gold-gradient flex items-center justify-center text-amber-200 text-xs font-black shadow-md shadow-amber-950/20 group-hover:scale-105 transition transform shrink-0">
                            VC
                        </div>
                        <div class="hidden sm:block">
                            <span class="font-heading font-bold text-lg tracking-wider text-red-900 group-hover:text-amber-700 transition block leading-tight">VIVAH CONNECT</span>
                            <span class="text-[9px] uppercase font-semibold text-amber-700 tracking-widest block -mt-0.5">Sacred Matrimonial Union</span>
                        </div>
                    </div>
                </div>

                <!-- Center / Right Controls: ZERO TABS! Status Pill, Pro Pass, User Avatar -->
                <div class="flex items-center space-x-3 shrink-0">
                    <!-- Operational System Live Status Pill -->
                    <div class="hidden xl:flex items-center space-x-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200/80 text-[11px] font-semibold text-amber-900">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Dharmic Matchmaking Live</span>
                    </div>

                    @if(!auth()->user()->isPro())
                    <a href="{{ route('membership.index') }}" class="hidden sm:inline-flex items-center space-x-1.5 bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-xs transition shrink-0 whitespace-nowrap">
                        <span>✨</span>
                        <span>Single Vivah Pass</span>
                    </a>
                    @else
                    <span class="hidden sm:inline-flex items-center space-x-1.5 bg-amber-100 text-amber-900 text-xs font-bold px-3 py-1 rounded-full border border-amber-300 shrink-0 whitespace-nowrap">
                        <span>⭐</span>
                        <span>Pro Pass</span>
                    </span>
                    @endif

                    <!-- User Profile Pill -->
                    <a href="{{ route('profile.show') }}" class="flex items-center space-x-2 pl-2 border-l border-amber-200 group shrink-0" title="My Profile">
                        <div class="w-9 h-9 rounded-full bg-red-900 text-amber-100 font-bold flex items-center justify-center border-2 border-amber-400 text-xs shadow-xs group-hover:scale-105 transition shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="hidden md:block text-left whitespace-nowrap">
                            <span class="text-xs font-bold text-gray-800 group-hover:text-red-900 block truncate max-w-[120px]">{{ auth()->user()->name }}</span>
                            <span class="text-[10px] text-amber-700 font-semibold block capitalize">{{ auth()->user()->role === 'family_rep' ? 'Family Elder' : auth()->user()->gender }}</span>
                        </div>
                    </a>

                    <!-- Sign Out Form -->
                    <form method="POST" action="{{ route('logout') }}" class="inline shrink-0">
                        @csrf
                        <button type="submit" class="p-2 text-stone-400 hover:text-red-700 transition cursor-pointer" title="Sign Out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Flash Alert Messages -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
                @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-start space-x-3 shadow-xs animate-fade-in">
                    <span class="text-emerald-600 text-xl">✓</span>
                    <div class="flex-1 font-medium text-sm">{{ session('success') }}</div>
                </div>
                @endif

                @if(session('error'))
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-900 flex items-start space-x-3 shadow-xs animate-fade-in">
                    <span class="text-red-600 text-xl">⚠️</span>
                    <div class="flex-1 font-medium text-sm">{{ session('error') }}</div>
                </div>
                @endif

                @if(session('info'))
                <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 flex items-start space-x-3 shadow-xs animate-fade-in">
                    <span class="text-amber-600 text-xl">ℹ️</span>
                    <div class="flex-1 font-medium text-sm">{{ session('info') }}</div>
                </div>
                @endif

                @if($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-900 shadow-xs">
                    <div class="font-bold text-sm mb-1 flex items-center space-x-1.5">
                        <span>⚠️</span>
                        <span>Please address the following requirements:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Main Content Area -->
            <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </main>

            <!-- Auspicious Footer -->
            <footer class="bg-red-950 text-amber-100/80 border-t border-amber-900/60 mt-12 py-10 text-xs">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                        <div>
                            <div class="flex items-center space-x-2 mb-3">
                                <div class="w-7 h-7 rounded-full bg-amber-500/20 text-amber-300 font-bold flex items-center justify-center text-xs">VC</div>
                                <span class="font-heading font-bold text-lg text-amber-200">VIVAH CONNECT</span>
                            </div>
                            <p class="text-amber-200/60 leading-relaxed">
                                Dedicated high-trust matrimonial platform adhering strictly to Hindu customary traditions, statutory legal codes, anti-dowry protocols, and familial dignity.
                            </p>
                        </div>
                        <div>
                            <h4 class="font-bold text-amber-300 uppercase tracking-wider mb-3">Customary & Legal Safeguards</h4>
                            <ul class="space-y-1.5 text-amber-200/70">
                                <li>• Statutory Minimum Age (21 M / 18 F)</li>
                                <li>• Strict Monogamy Policy (Polygamy Barred)</li>
                                <li>• Zero Dowry Policy (Dowry Prohibition Act)</li>
                                <li>• Contact Shield & Masked Messaging</li>
                                <li>• Family Representative Delegation</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold text-amber-300 uppercase tracking-wider mb-3">Astrology & Heritage</h4>
                            <ul class="space-y-1.5 text-amber-200/70">
                                <li>• 36-Point Ashtakoota Guna Milan</li>
                                <li>• Manglik Status & Cancellation Assessment</li>
                                <li>• Gotra & Nanihal Ancestral Lineage</li>
                                <li>• Optional "Horoscope Not Required" Toggle</li>
                                <li>• Dignified Remarriage Support</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold text-amber-300 uppercase tracking-wider mb-3">Global Dharmic Communities</h4>
                            <p class="text-amber-200/60 mb-3">
                                Serving Hindu, Jain, Sikh, and Buddhist seekers worldwide across North America, Europe, United Kingdom, Asia-Pacific, and the Global Diaspora with auspicious dignity.
                            </p>
                            <div class="p-2.5 rounded-lg bg-amber-900/30 border border-amber-800/40 text-[11px] text-amber-300">
                                🛡️ 100% International Government ID & Liveness KYC Verified Network
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-amber-900/40 flex flex-wrap justify-between items-center text-amber-300/60 text-[11px]">
                        <div>© 2026 Vivah Connect. Worldwide International Matrimonial Union. All rights reserved.</div>
                        <div class="flex space-x-4">
                            <span>Compliance: International Matrimonial Standards • GDPR & DPDP Compliant • Anti-Dowry & Anti-Extortion Enforcement</span>
                            <span>•</span>
                            <a href="{{ route('milestone.index') }}" class="hover:text-amber-200 underline">Shubho Bibaho Registry</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @endauth

    @guest
    {{-- ========================================================= --}}
    {{-- GUEST USER: MINIMAL CLEAN HEADER                          --}}
    {{-- ========================================================= --}}
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b border-amber-100 shadow-xs sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <a href="{{ route('discovery.index') }}" class="flex items-center space-x-2.5 group">
                        <div class="w-9 h-9 rounded-xl gold-gradient flex items-center justify-center text-amber-200 text-xs font-black shadow-md shadow-amber-950/20 group-hover:scale-105 transition">
                            VC
                        </div>
                        <div>
                            <span class="font-heading font-bold text-lg tracking-wider text-red-900 group-hover:text-amber-700 transition block leading-tight">VIVAH CONNECT</span>
                            <span class="text-[9px] uppercase font-semibold text-amber-700 tracking-widest block -mt-0.5">Sacred Matrimonial Union</span>
                        </div>
                    </a>

                    <!-- Quick Demo Personas & Auth Links -->
                    <div class="flex items-center space-x-3">
                        <div class="hidden md:flex items-center space-x-1.5 text-xs text-stone-600">
                            <span class="text-amber-800 font-semibold">Demo:</span>
                            <a href="{{ route('demo.login', ['email' => 'arun@example.com']) }}" class="px-2 py-1 rounded bg-amber-100/70 hover:bg-amber-200 text-amber-900 font-medium">Groom</a>
                            <a href="{{ route('demo.login', ['email' => 'priya@example.com']) }}" class="px-2 py-1 rounded bg-amber-100/70 hover:bg-amber-200 text-amber-900 font-medium">Bride</a>
                            <a href="{{ route('demo.login', ['email' => 'subhash@example.com']) }}" class="px-2 py-1 rounded bg-amber-100/70 hover:bg-amber-200 text-amber-900 font-medium">Family</a>
                            <a href="{{ route('demo.login', ['email' => 'admin@vivahconnect.com']) }}" class="px-2 py-1 rounded bg-red-100 hover:bg-red-200 text-red-900 font-medium">Admin</a>
                        </div>
                        <a href="{{ route('login') }}" class="px-3.5 py-1.5 rounded-lg border border-red-900 text-red-900 hover:bg-red-50 text-xs font-bold transition">Sign In</a>
                        <a href="{{ route('register') }}" class="px-3.5 py-1.5 rounded-lg bg-red-900 hover:bg-red-800 text-amber-100 text-xs font-bold shadow-xs transition">Create Account</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Alert Messages for Guests -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-start space-x-3 shadow-xs">
                <span class="text-emerald-600 text-xl">✓</span>
                <div class="flex-1 font-medium text-sm">{{ session('success') }}</div>
            </div>
            @endif

            @if(session('error'))
            <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-900 flex items-start space-x-3 shadow-xs">
                <span class="text-red-600 text-xl">⚠️</span>
                <div class="flex-1 font-medium text-sm">{{ session('error') }}</div>
            </div>
            @endif

            @if($errors->any())
            <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-900 shadow-xs">
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-red-950 text-amber-100/80 border-t border-amber-900/60 mt-12 py-8 text-xs text-center">
            <p>© 2026 Vivah Connect. Sacred Matrimonial Union. All rights reserved.</p>
        </footer>
    </div>
    @endguest

    @yield('scripts')
</body>
</html>
