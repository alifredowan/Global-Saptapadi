<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Global Saptapadi is a family-first international Hindu matrimony platform. Seven steps. One lifetime. Privacy-protected biodatas, optional 36-point Ashtakoota Guna Milan (Vedic compatibility), and strict zero-dowry ethics.">
    <meta name="theme-color" content="#8B1E2D">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Global Saptapadi">
    <meta property="og:title" content="Global Saptapadi — Seven steps. One lifetime.">
    <meta property="og:description" content="International Hindu matrimony connecting intentional seekers and families across the UK, USA, Canada, UAE, Singapore, India, Bangladesh, and Nepal.">
    <meta property="og:image" content="{{ asset('images/logo-full.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <title>{{ config('app.name', 'Global Saptapadi') }} — Seven steps. One lifetime.</title>
    
    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-emblem.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-emblem.png') }}">
    
    <!-- Human-Crafted Google Fonts: Cormorant Garamond (Headings) & DM Sans (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;0,700;1,600;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,500&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    
    <!-- Instant Theme Mode Initialization (Prevents Light/Dark Flicker) -->
    <script>
        (function() {
            try {
                var theme = localStorage.getItem('saptapadi_theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('data-theme', 'light');
                }
            } catch(e) {}
        })();
    </script>

    <!-- Design Tokens, Theme CSS & Real-Time WebSockets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        html {
            scroll-behavior: smooth;
            -webkit-tap-highlight-color: transparent;
        }
        body {
            background-color: var(--color-bg, #FFFBF3);
            color: var(--color-text, #1A1A1A);
        }
        /* Refined, quiet scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--color-surface-alt, #F8F1E4);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--color-border, #EADFCB);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--color-primary, #8B1E2D);
        }
    </style>
</head>
<body class="h-full paper-texture antialiased text-[var(--color-text)] selection:bg-[var(--color-accent)] selection:text-white"
      x-data="{
          sidebarOpen: (function() {
              try { return localStorage.getItem('vivah_sidebar_expanded') === 'true'; } catch(e) { return false; }
          })(),
          mobileSidebarOpen: false,
          notifOpen: false,
          notifTab: 'all',
          accountOpen: false,
          mobileAccountOpen: false,
          isDark: (function() {
              try {
                  var saved = localStorage.getItem('saptapadi_theme');
                  return saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches);
              } catch(e) { return false; }
          })(),
          toggleTheme() {
              this.isDark = !this.isDark;
              try { localStorage.setItem('saptapadi_theme', this.isDark ? 'dark' : 'light'); } catch(e){}
              if (this.isDark) {
                  document.documentElement.classList.add('dark');
                  document.documentElement.setAttribute('data-theme', 'dark');
              } else {
                  document.documentElement.classList.remove('dark');
                  document.documentElement.setAttribute('data-theme', 'light');
              }
          },
          toggleSidebar() {
              if (window.innerWidth >= 1024) {
                  this.sidebarOpen = !this.sidebarOpen;
                  try { localStorage.setItem('vivah_sidebar_expanded', this.sidebarOpen); } catch(e){}
              } else {
                  this.mobileSidebarOpen = !this.mobileSidebarOpen;
              }
          },
          closeAccountMenu() {
              this.accountOpen = false;
              if (this.$refs.accountButton) {
                  this.$refs.accountButton.focus();
              }
          },
          focusFirstMenuItem() {
              var menu = document.getElementById('account-menu-dropdown');
              if (!menu) return;
              var items = menu.querySelectorAll('.account-menu-item');
              if (items.length > 0) items[0].focus();
          },
          navigateMenu(direction) {
              var menu = document.getElementById('account-menu-dropdown');
              if (!menu) return;
              var items = Array.from(menu.querySelectorAll('.account-menu-item'));
              var currentIndex = items.indexOf(document.activeElement);
              var nextIndex = currentIndex + direction;
              if (nextIndex < 0) nextIndex = items.length - 1;
              if (nextIndex >= items.length) nextIndex = 0;
              items[nextIndex].focus();
          },
          navigateMenuTo(position) {
              var menu = document.getElementById('account-menu-dropdown');
              if (!menu) return;
              var items = Array.from(menu.querySelectorAll('.account-menu-item'));
              if (items.length === 0) return;
              if (position === 'last') items[items.length - 1].focus();
              else items[0].focus();
          }
      }">

    @auth
    @php
        $navUser = Auth::user();
        $navUnreadMessagesCount = $navUser ? \App\Models\Message::where('receiver_user_id', $navUser->id)->whereNull('read_at')->count() : 0;
        $navPendingProposalsCount = $navUser ? $navUser->receivedProposals()->where('status', 'pending')->count() : 0;
        $navShortlistsCount = $navUser ? $navUser->shortlists()->count() : 0;
        $navRecentPendingProposals = $navUser ? $navUser->receivedProposals()->with('sender.profile')->where('status', 'pending')->latest()->take(5)->get() : collect();
        $navRecentMessages = $navUser ? \App\Models\Message::where('receiver_user_id', $navUser->id)->with('sender.profile')->latest()->take(5)->get() : collect();
        $navFamilyReps = $navUser ? \App\Models\FamilyRepresentative::where('seeker_user_id', $navUser->id)->orWhere('rep_user_id', $navUser->id)->with(['seekerUser.profile', 'representativeUser.profile'])->latest()->take(4)->get() : collect();
    @endphp
    {{-- ========================================================= --}}
    {{-- AUTHENTICATED USER: REFINED DIGNIFIED SIDEBAR LAYOUT     --}}
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
                 x-transition:enter="transition-opacity ease-linear duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="mobileSidebarOpen = false"
                 class="fixed inset-0 bg-[#171312]/75 backdrop-blur-[2px]"></div>

            <!-- Mobile Drawer -->
            <div x-show="mobileSidebarOpen"
                 x-transition:enter="transition ease-out duration-250 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="relative mr-16 flex-1 w-full max-w-xs bg-[#1F1918] border-r border-[#382E2B] text-stone-200 flex flex-col py-5 px-4 shadow-xl">
                
                <!-- Close Button -->
                <div class="absolute top-4 right-4">
                    <button type="button"
                            @click="mobileSidebarOpen = false"
                            class="p-2 rounded-[var(--radius-sm)] text-stone-400 hover:text-white hover:bg-white/5 focus:outline-none cursor-pointer"
                            title="Close Navigation">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Brand in Mobile Drawer -->
                <div @click="mobileSidebarOpen = false" class="flex items-center gap-3 px-2 mb-6 cursor-pointer select-none">
                    <img src="{{ asset('images/logo-emblem.png') }}" alt="Global Saptapadi" class="w-9 h-9 rounded-[var(--radius-sm)] object-cover border border-[#382E2B] shrink-0">
                    <div>
                        <span class="font-serif font-bold text-lg text-stone-100 tracking-wide block leading-tight">
                            Global Saptapadi
                        </span>
                        <span class="text-[10px] text-[var(--secondary-text)] block font-medium">
                            Seven steps. One lifetime.
                        </span>
                    </div>
                </div>

                <!-- Navigation Links in Drawer -->
                <nav class="flex-1 overflow-y-auto pr-1">
                    @include('layouts.partials.sidebar-nav')
                </nav>

                <!-- Mobile User Card (Opens Standardized Account Menu) -->
                <div class="pt-4 mt-4 border-t border-[#382E2B]">
                    <button type="button"
                            @click="mobileSidebarOpen = false; mobileAccountOpen = true"
                            class="w-full flex items-center justify-between gap-2.5 px-2 py-2 rounded-[var(--radius-sm)] bg-[#171312] border border-[#382E2B] hover:border-stone-600 transition cursor-pointer text-left">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white font-bold flex items-center justify-center text-xs shrink-0 font-serif">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-stone-400 capitalize">{{ Auth::user()->role === 'family_rep' ? 'Family Elder' : (Auth::user()->role === 'admin' ? 'Administrator' : 'Candidate') }}</p>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Desktop Collapsible Sidebar -->
        <aside x-show="sidebarOpen"
               x-cloak
               x-transition:enter="transition-all ease-out duration-250"
               x-transition:enter-start="opacity-0 -translate-x-full w-0"
               x-transition:enter-end="opacity-100 translate-x-0 w-68"
               x-transition:leave="transition-all ease-in duration-200"
               x-transition:leave-start="opacity-100 translate-x-0 w-68"
               x-transition:leave-end="opacity-0 -translate-x-full w-0"
               class="hidden lg:flex lg:flex-col lg:w-68 bg-[#1F1918] text-stone-200 border-r border-[#382E2B] shrink-0 sticky top-0 h-screen z-30 transition-all duration-200 shadow-sm overflow-hidden">
            
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-[#382E2B] flex items-center justify-between gap-2 shrink-0">
                <button type="button"
                        @click="toggleSidebar()"
                        class="flex items-center gap-2.5 group flex-1 min-w-0 text-left cursor-pointer focus:outline-none"
                        title="Toggle Navigation Sidebar">
                    <img src="{{ asset('images/logo-emblem.png') }}" alt="Global Saptapadi" class="w-8 h-8 rounded-[var(--radius-sm)] object-cover border border-[#382E2B] shrink-0">
                    <div class="min-w-0 flex-1">
                        <div class="font-serif font-bold text-base text-stone-100 tracking-wide group-hover:text-[var(--secondary-text)] transition truncate leading-tight">
                            Global Saptapadi
                        </div>
                        <div class="text-[9px] uppercase tracking-wider font-medium text-stone-400 truncate">
                            @if(Auth::user()->role === 'family_rep')
                                Family Portal
                            @elseif(Auth::user()->role === 'admin')
                                Administration
                            @else
                                {{ Auth::user()->gender === 'female' ? 'Kanya Portal' : 'Var Portal' }}
                            @endif
                        </div>
                    </div>
                </button>
                <button type="button"
                        @click="toggleSidebar()"
                        class="p-1.5 rounded-[var(--radius-sm)] text-stone-400 hover:text-white hover:bg-white/5 transition focus:outline-none cursor-pointer"
                        title="Collapse Sidebar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 p-3.5 overflow-y-auto">
                @include('layouts.partials.sidebar-nav')
            </nav>

            <!-- Sidebar Footer User Card (Triggers Standardized Account Menu) -->
            <div class="p-3 border-t border-[#382E2B] bg-[#171312] shrink-0">
                <button type="button"
                        @click="accountOpen = !accountOpen; if(accountOpen) { $nextTick(() => focusFirstMenuItem()); }"
                        class="w-full flex items-center justify-between gap-2 p-2 rounded-[var(--radius-sm)] bg-[#1F1918] border border-[#382E2B] hover:border-stone-600 transition cursor-pointer text-left group">
                    <div class="flex items-center gap-2 min-w-0">
                        <div class="w-7 h-7 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white font-bold flex items-center justify-center text-xs shrink-0 font-serif">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-white truncate group-hover:text-[var(--secondary-text)] transition">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-stone-400 truncate capitalize">
                                {{ Auth::user()->role === 'family_rep' ? 'Family Elder' : (Auth::user()->role === 'admin' ? 'Administrator' : 'Candidate') }}
                            </p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-stone-400 group-hover:text-white transition" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>
            </div>
        </aside>

        <!-- Main Canvas -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Standardized Authenticated Header -->
            <!-- Specs: Desktop 64px (h-16), Mobile 56px (h-14).
                 Left: Logo + Drawer toggle.
                 Center/Left-next-to-logo: Main navigation (Discover, Interests, Shortlist, Kundli).
                 Right side (strict order): Messages -> Notifications -> Theme Toggle -> Avatar Account Menu.
                 NO standalone logout icon in header! -->
            <header class="sticky top-0 z-40 h-14 lg:h-16 bg-[var(--bg-surface)] border-b border-[var(--border-default)] shadow-xs flex items-center justify-between px-4 sm:px-6 lg:px-8 transition-colors">
                <!-- Left: Toggle & Brand Details -->
                <div class="flex items-center gap-3 shrink-0">
                    <button type="button"
                            @click="toggleSidebar()"
                            class="p-2 rounded-[var(--radius-sm)] text-[var(--text-secondary)] hover:text-[var(--accent-primary)] hover:bg-[var(--bg-subtle)] border border-[var(--border-default)] transition focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] cursor-pointer flex items-center justify-center shrink-0"
                            aria-label="Toggle navigation drawer"
                            title="Toggle portal navigation">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </button>

                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-2.5 group shrink-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] rounded-md">
                        <img src="{{ asset('images/logo-emblem.png') }}"
                             alt="Global Saptapadi"
                             class="w-7 h-7 sm:w-8 sm:h-8 rounded-[var(--radius-sm)] object-cover border border-[var(--border-default)] shrink-0">
                        <div class="hidden sm:block">
                            <span class="font-serif font-bold text-base tracking-wide text-[var(--accent-primary)] group-hover:text-[var(--accent-hover)] transition block leading-tight">
                                Global Saptapadi
                            </span>
                            <span class="text-[9px] uppercase font-semibold text-[var(--text-muted)] tracking-wider block -mt-0.5">
                                Seven steps. One lifetime.
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Center / Left-next-to-logo: Main Navigation (Desktop Only) -->
                <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2 text-sm font-medium text-[var(--text-secondary)] h-16"
                     aria-label="Main Navigation">
                    <a href="{{ route('discovery.index') }}"
                       class="relative h-16 flex items-center px-3.5 transition {{ request()->routeIs('discovery.*') ? 'text-[var(--accent-primary)] font-semibold after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[var(--accent-primary)]' : 'hover:text-[var(--text-primary)] hover:bg-stone-500/5' }}">
                        Discover
                    </a>

                    <a href="{{ route('proposals.index') }}"
                       class="relative h-16 flex items-center px-3.5 transition {{ request()->routeIs('proposals.*') ? 'text-[var(--accent-primary)] font-semibold after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[var(--accent-primary)]' : 'hover:text-[var(--text-primary)] hover:bg-stone-500/5' }}">
                        <span>Interests</span>
                        @if($navPendingProposalsCount > 0)
                            <span class="ml-1.5 px-1.5 py-0.2 rounded-full text-[10px] font-bold bg-[var(--color-primary)] text-white">
                                {{ $navPendingProposalsCount > 9 ? '9+' : $navPendingProposalsCount }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('shortlists.index') }}"
                       class="relative h-16 flex items-center px-3.5 transition {{ request()->routeIs('shortlists.*') ? 'text-[var(--accent-primary)] font-semibold after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[var(--accent-primary)]' : 'hover:text-[var(--text-primary)] hover:bg-stone-500/5' }}">
                        <span>Shortlist</span>
                        @if($navShortlistsCount > 0)
                            <span class="ml-1.5 px-1.5 py-0.2 rounded-full text-[10px] font-semibold bg-stone-200 dark:bg-stone-700 text-stone-700 dark:text-stone-300">
                                {{ $navShortlistsCount }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('horoscope.edit') }}"
                       class="relative h-16 flex items-center px-3.5 transition {{ request()->routeIs('horoscope.*') ? 'text-[var(--accent-primary)] font-semibold after:absolute after:bottom-0 after:left-3 after:right-3 after:h-0.5 after:bg-[var(--accent-primary)]' : 'hover:text-[var(--text-primary)] hover:bg-stone-500/5' }}">
                        Kundli
                    </a>
                </nav>

                <!-- Right Side: Standardized Controls -->
                <!-- Desktop: Messages -> Notifications -> Theme Toggle -> Avatar Account Menu -->
                <div class="hidden lg:flex items-center">
                    @include('layouts.partials.header-actions')
                </div>

                <!-- Mobile Top Bar Right: Notifications & Avatar (Messages is on the bottom bar!) -->
                <div class="flex lg:hidden items-center gap-2">
                    {{-- Notifications Bell (Mobile) --}}
                    <div class="relative">
                        <button type="button"
                                @click="notifOpen = !notifOpen"
                                class="relative w-10 h-10 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-stone-500/10 transition cursor-pointer"
                                aria-label="Notifications">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                            </svg>
                            @if($navPendingProposalsCount > 0)
                                <span class="absolute -top-0.5 -right-0.5 w-4 h-4 rounded-full bg-[var(--color-primary)] text-white text-[9px] font-bold flex items-center justify-center ring-2 ring-[var(--bg-surface)]">
                                    {{ $navPendingProposalsCount > 9 ? '9+' : $navPendingProposalsCount }}
                                </span>
                            @endif
                        </button>

                        {{-- Mobile Dropdown/Sheet Notifications --}}
                        @include('layouts.partials.notifications-panel')
                    </div>

                    {{-- Avatar Trigger for Mobile Bottom Sheet --}}
                    <button type="button"
                            @click="mobileAccountOpen = true"
                            class="w-8 h-8 rounded-full overflow-hidden bg-[var(--accent-primary)] text-white font-serif font-bold text-xs flex items-center justify-center border border-[var(--border-default)] cursor-pointer"
                            aria-label="Account menu">
                        @if($navUser->primary_photo_url && !str_contains($navUser->primary_photo_url, 'unsplash'))
                            <img src="{{ $navUser->primary_photo_url }}" alt="{{ $navUser->name }}" class="w-full h-full object-cover">
                        @else
                            <span>{{ strtoupper(substr($navUser->name, 0, 1)) }}</span>
                        @endif
                    </button>
                </div>

            </header>

            <!-- Flash Alert Messages -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
                @if(session('success'))
                <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-[var(--color-success)] flex items-start space-x-2.5 text-xs font-medium">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                    <div class="flex-1">{{ session('success') }}</div>
                </div>
                @endif

                @if(session('error'))
                <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] border border-[var(--color-danger-border)] text-[var(--color-danger)] flex items-start space-x-2.5 text-xs font-medium">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <div class="flex-1">{{ session('error') }}</div>
                </div>
                @endif

                @if(session('info'))
                <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-info-bg)] border border-[var(--color-info-border)] text-[var(--color-info)] flex items-start space-x-2.5 text-xs font-medium">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01"/></svg>
                    <div class="flex-1">{{ session('info') }}</div>
                </div>
                @endif

                @if($errors->any())
                <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] border border-[var(--color-danger-border)] text-[var(--color-danger)] text-xs space-y-1">
                    <div class="font-semibold mb-1">Please review the details below:</div>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Main Content Area -->
            <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-20 lg:pb-6">
                @yield('content')
            </main>

            <!-- Human-Crafted Footer -->
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- Mobile Bottom Tab Bar (Max 5 items: Discover, Interests, Messages, Shortlist, Profile) -->
    @include('layouts.partials.mobile-bottom-nav')
    @endauth

    @guest
    {{-- ========================================================= --}}
    {{-- GUEST USER: REFINED EDITORIAL NAVIGATION                   --}}
    {{-- ========================================================= --}}
    <div class="min-h-screen flex flex-col">
        <!-- Standardized Guest Header (Logo, How it works, Theme toggle, Sign in, Create profile) -->
        @include('layouts.partials.header-guest')

        <!-- Flash Alert Messages for Guests -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            @if(session('success'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-[var(--color-success)] flex items-start space-x-2.5 text-xs font-medium">
                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                <div class="flex-1">{{ session('success') }}</div>
            </div>
            @endif

            @if(session('error'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] border border-[var(--color-danger-border)] text-[var(--color-danger)] flex items-start space-x-2.5 text-xs font-medium">
                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div class="flex-1">{{ session('error') }}</div>
            </div>
            @endif

            @if(session('info'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-info-bg)] border border-[var(--color-info-border)] text-[var(--color-info)] flex items-start space-x-2.5 text-xs font-medium">
                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01"/></svg>
                <div class="flex-1">{{ session('info') }}</div>
            </div>
            @endif

            @if($errors->any())
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] border border-[var(--color-danger-border)] text-[var(--color-danger)] text-xs space-y-1">
                <div class="font-semibold mb-1">Please review the details below:</div>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <main class="flex-1 w-full">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.partials.footer')
    </div>
    @endguest

    <!-- Floating Global Feedback Toast (e.g. 'You have been signed out.') -->
    @if(session('info') || session('success') || session('error'))
    <div x-data="{ showToast: true }"
         x-init="setTimeout(() => showToast = false, 4500)"
         x-show="showToast"
         x-cloak
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-3"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-3"
         class="fixed bottom-20 right-4 sm:bottom-6 sm:right-6 z-50 max-w-sm rounded-lg border shadow-xl p-3.5 flex items-center gap-3 text-xs font-medium {{ session('error') ? 'bg-[var(--color-danger-bg)] border-[var(--color-danger-border)] text-[var(--color-danger)]' : (session('success') ? 'bg-[var(--color-success-bg)] border-[var(--color-success-border)] text-[var(--color-success)]' : 'bg-[var(--bg-surface)] border-[var(--border-default)] text-[var(--text-primary)]') }}"
         role="status"
         aria-live="polite">
        <div class="w-2 h-2 rounded-full {{ session('error') ? 'bg-[var(--color-danger)]' : (session('success') ? 'bg-[var(--color-success)]' : 'bg-[var(--accent-primary)]') }} shrink-0"></div>
        <div class="flex-1">{{ session('info') ?? session('success') ?? session('error') }}</div>
        <button type="button" @click="showToast = false" class="text-[var(--text-muted)] hover:text-[var(--text-primary)] cursor-pointer" aria-label="Dismiss toast">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    <!-- Privacy & Cookie Banner -->
    @include('layouts.partials.cookie-banner')

    @yield('scripts')
</body>
</html>
