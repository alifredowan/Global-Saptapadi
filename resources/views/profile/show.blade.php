@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Profile Banner -->
    <div class="bg-white rounded-3xl border border-amber-200 overflow-hidden shadow-sm">
        <div class="h-44 gold-gradient relative">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            @if($isOwnProfile)
            <a href="{{ route('profile.edit') }}" class="absolute top-4 right-4 bg-white/90 hover:bg-white text-red-950 font-bold text-xs px-4 py-2 rounded-xl shadow transition flex items-center space-x-1.5">
                <span>✏️</span>
                <span>Edit My Biodata</span>
            </a>
            @endif
        </div>

        <div class="px-6 sm:px-8 pb-8 pt-0 relative">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between -mt-20 gap-4 mb-6">
                <!-- Avatar & Status -->
                <div class="flex items-end space-x-4">
                    <div class="w-36 h-36 rounded-2xl border-4 border-white shadow-xl bg-gray-100 overflow-hidden relative">
                        <img src="{{ $canViewPhotos ? $user->primary_photo_url : $user->blurred_photo_url }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full object-cover {{ !$canViewPhotos ? 'filter blur-sm scale-110' : '' }}">
                        
                        @if(!$canViewPhotos)
                        <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-white text-center p-2">
                            <span class="text-xl">🔒</span>
                            <span class="text-[9px] font-bold uppercase tracking-wider">Modesty Blurred</span>
                        </div>
                        @endif
                    </div>

                    <div class="pb-2">
                        <div class="flex items-center space-x-2">
                            <h1 class="font-heading font-bold text-2xl sm:text-3xl text-gray-900">{{ $user->name }}</h1>
                            @if($user->is_verified)
                            <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2.5 py-0.5 rounded-full border border-emerald-300 flex items-center space-x-1" title="Government ID & Live Selfie KYC Verified">
                                <span>✓</span>
                                <span>Verified Seeker</span>
                            </span>
                            @endif
                        </div>
                        <p class="text-xs sm:text-sm text-amber-900 font-semibold mt-1">
                            {{ $user->age }} Years • {{ $profile?->city ?? 'Location Open' }}, {{ $profile?->country ?? 'Global Diaspora' }} • Managed by {{ ucfirst($user->profile_managed_by) }}
                        </p>
                    </div>
                </div>

                <!-- Interaction CTA (if viewing someone else) -->
                @if(!$isOwnProfile)
                <div class="flex items-center space-x-3 pb-2">
                    <a href="{{ route('horoscope.compare', $user->id) }}" class="px-4 py-2.5 rounded-xl border border-amber-300 bg-amber-50 hover:bg-amber-100 text-amber-950 text-xs font-bold transition flex items-center space-x-1.5">
                        <span>🪐</span>
                        <span>Ashtakoota Guna Milan</span>
                    </a>

                    @if(auth()->user()->hasMutualInterestWith($user->id))
                    <a href="{{ route('chat.show', $user->id) }}" class="px-5 py-2.5 rounded-xl gold-gradient text-white text-xs font-bold shadow transition flex items-center space-x-1.5">
                        <span>💬</span>
                        <span>Open Chaperoned Chat</span>
                    </a>
                    @else
                    <form method="POST" action="{{ route('proposals.store', $user->id) }}">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 rounded-xl gold-gradient text-white text-xs font-bold shadow hover:opacity-95 transition flex items-center space-x-1.5">
                            <span>💌</span>
                            <span>Transmit Formal Interest</span>
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>

            <!-- Completeness Bar -->
            <div class="bg-amber-50/60 border border-amber-200/80 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <div class="flex items-center space-x-2">
                    <span class="font-bold text-amber-950 uppercase tracking-wider">Biodata Completeness:</span>
                    <span class="font-extrabold text-amber-900">{{ $profile?->profile_completeness_pct ?? 60 }}%</span>
                </div>
                <div class="w-full sm:w-64 bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div class="gold-gradient h-full rounded-full" style="width: {{ $profile?->profile_completeness_pct ?? 60 }}%"></div>
                </div>
                <div class="text-[11px] text-gray-500">
                    High-trust verified biodatas receive 4.5x higher matching discovery.
                </div>
            </div>
        </div>
    </div>

    <!-- Main Biodata Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left 2 Columns: Detailed Specifications -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Narrative About Me -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/90 shadow-sm space-y-3">
                <h3 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                    <span>📜</span>
                    <span>Candidate Narrative & Personal Reflections</span>
                </h3>
                <p class="text-sm text-gray-700 leading-relaxed italic bg-amber-50/30 p-4 rounded-xl border border-amber-100">
                    "{{ $profile?->about_me ?? 'A peaceful Dharmic soul seeking a lifelong companion built upon mutual respect, devotion, and cultural harmony.' }}"
                </p>
            </div>

            <!-- Cultural, Spiritual & Heritage Classification (FR-2.3, FR-2.4, FR-2.6) -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/90 shadow-sm space-y-4">
                <h3 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                    <span>🪔</span>
                    <span>Lineage, Community & Spiritual Practice</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Religion & Sampradaya</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $profile?->religion ?? 'Hindu' }} ({{ $profile?->sampradaya ?? 'General Dharmic' }})</span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Community & Sub-Caste</span>
                        <span class="font-semibold text-gray-900 text-sm">
                            @if($profile?->mask_caste && !$isOwnProfile)
                                <span class="text-gray-400 italic">Masked by candidate ("Caste No Bar")</span>
                            @else
                                {{ $profile?->caste_jati ?? 'Hindu' }} @if($profile?->sub_caste) • {{ $profile->sub_caste }} @endif
                            @endif
                        </span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Paternal Gotra</span>
                        <span class="font-semibold text-gray-900 text-sm">
                            @if($profile?->mask_gotra && !$isOwnProfile)
                                <span class="text-gray-400 italic">Masked until mutual interest</span>
                            @else
                                {{ $profile?->gotra ?? 'Not Stated' }}
                            @endif
                        </span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Maternal Lineage (Nanihal Gotra)</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $profile?->nanihal_gotra ?? 'Not Stated' }}</span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Daily Puja & Temple Visits</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ ucfirst($profile?->puja_frequency ?? 'Daily') }} Puja • {{ ucfirst($profile?->temple_visits ?? 'Weekly') }} visits</span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Fasting (Vrata) & Scripture</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ ucfirst($profile?->fasting_vrata ?? 'Festivals') }} • {{ ucfirst($profile?->scripture_study ?? 'Occasional') }}</span>
                    </div>
                </div>
            </div>

            <!-- Education & Professional Background (FR-2.2) -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/90 shadow-sm space-y-4">
                <h3 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                    <span>🎓</span>
                    <span>Education & Professional Dossier</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Highest Qualification</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $profile?->qualification_level ?? 'Graduate' }}</span>
                        <span class="text-gray-600 block mt-0.5">{{ $profile?->education_detail }}</span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Profession & Enterprise</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $profile?->profession ?? 'Professional' }}</span>
                        <span class="text-gray-600 block mt-0.5">{{ $profile?->organization_type }}</span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Annual Gross Income Range</span>
                        <span class="font-semibold text-gray-900 text-sm">
                            @if($profile?->mask_income && !$isOwnProfile)
                                <span class="text-gray-400 italic">Disclosed to mutual matches only</span>
                            @else
                                {{ $profile?->annual_income_range ?? 'Available upon request' }}
                            @endif
                        </span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Citizenship & Native Ancestry</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $profile?->citizenship ?? 'Global Citizen' }} • {{ $profile?->native_ancestry ?? 'Ancestral Heritage' }}</span>
                    </div>
                </div>
            </div>

            <!-- Family Heritage & Background (FR-2.7) -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/90 shadow-sm space-y-4">
                <h3 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                    <span>🏡</span>
                    <span>Family Values & Living Arrangements</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Family Structure & Values</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ ucfirst($profile?->family_structure ?? 'Nuclear') }} Family • {{ ucfirst($profile?->family_values ?? 'Traditional') }} Values</span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Parents' Occupations</span>
                        <span class="font-semibold text-gray-900 text-sm">Father: {{ $profile?->father_occupation ?? 'Respected' }}</span>
                        <span class="text-gray-600 block">Mother: {{ $profile?->mother_occupation ?? 'Homemaker' }}</span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Siblings</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $profile?->brothers_count ?? 0 }} Brother(s) • {{ $profile?->sisters_count ?? 0 }} Sister(s)</span>
                    </div>

                    <div class="p-3 bg-amber-50/40 rounded-xl border border-amber-100">
                        <span class="text-gray-400 block text-[10px] uppercase font-bold">Post-Marriage Living Preference</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ ucfirst(str_replace('_', ' ', $profile?->living_arrangements_preference ?? 'Flexible')) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Horoscope & Photo Gallery -->
        <div class="space-y-6">

            <!-- Astrological Natal Profile (FR-3.1, FR-3.4) -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/90 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                        <span>🪐</span>
                        <span>Janam Patrika / Kundli</span>
                    </h3>
                    @if($kundli?->horoscope_opt_out)
                    <span class="text-[10px] bg-gray-100 text-gray-600 px-2 py-0.5 rounded font-semibold">Opted Out</span>
                    @endif
                </div>

                @if(!$kundli || $kundli->horoscope_opt_out)
                    <div class="p-4 bg-gray-50 rounded-xl text-center text-xs text-gray-500">
                        "Horoscope Not Required" selected by candidate. Matching evaluates lifestyle, cultural traditions, and family values.
                    </div>
                @else
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between py-1.5 border-b border-gray-100">
                            <span class="text-gray-500">Rashi (Moon Sign):</span>
                            <span class="font-bold text-red-900">{{ $kundli->rashi ?? 'Not Specified' }}</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100">
                            <span class="text-gray-500">Nakshatra:</span>
                            <span class="font-bold text-red-900">{{ $kundli->nakshatra ?? 'Not Specified' }} (Charan {{ $kundli->charan ?? 1 }})</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-gray-100">
                            <span class="text-gray-500">Manglik Status:</span>
                            <span class="font-bold {{ $kundli->manglik_status === 'manglik' ? 'text-amber-800' : 'text-emerald-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $kundli->manglik_status ?? 'Non Manglik')) }}
                            </span>
                        </div>
                        <div class="flex justify-between py-1.5">
                            <span class="text-gray-500">Pandit Verification:</span>
                            <span class="font-bold {{ $kundli->chart_verified_by_pandit ? 'text-emerald-700' : 'text-gray-400' }}">
                                {{ $kundli->chart_verified_by_pandit ? '✓ Verified by Pandit' : 'Self-declared chart' }}
                            </span>
                        </div>
                    </div>

                    @if(!$isOwnProfile)
                    <a href="{{ route('horoscope.compare', $user->id) }}" class="block w-full py-2.5 rounded-xl text-center bg-amber-50 hover:bg-amber-100 border border-amber-300 text-amber-950 font-bold text-xs transition">
                        Compare 36-Point Guna Milan →
                    </a>
                    @endif
                @endif
            </div>

            <!-- Photo Gallery (Up to 6 Photos with Privacy Controls) -->
            <div class="bg-white rounded-2xl p-6 border border-amber-200/90 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                        <span>📷</span>
                        <span>Photo Gallery ({{ $user->photos->count() }}/6)</span>
                    </h3>
                    <span class="text-[10px] text-gray-500 font-semibold uppercase">
                        Privacy: {{ ucfirst(str_replace('_', ' ', $profile?->photo_privacy ?? 'blur_until_mutual')) }}
                    </span>
                </div>

                @if($user->photos->isEmpty())
                <div class="p-6 bg-amber-50/30 rounded-xl text-center text-xs text-gray-500">
                    No additional gallery photographs uploaded yet.
                </div>
                @else
                <div class="grid grid-cols-2 gap-2">
                    @foreach($user->photos as $p)
                    <div class="relative h-28 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                        <img src="{{ $canViewPhotos ? asset($p->photo_path) : asset($p->blurred_photo_path ?? $p->photo_path) }}" 
                             alt="Photo" 
                             class="w-full h-full object-cover {{ !$canViewPhotos ? 'filter blur-sm scale-110' : '' }}">
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

