@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-3xl p-6 sm:p-8 text-amber-100 shadow-md">
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-2">
            <span>🏛️</span>
            <span>Family Representative Governance Dashboard</span>
        </div>
        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-amber-100">
            Family Oversight & Proposal Approval Center
        </h1>
        <p class="text-xs text-amber-200/80 mt-1 leading-relaxed">
            Dharmic matrimonial facilitation empowering parents and elders to review proposals, grant blessings, and provide dignified chaperoned guidance.
        </p>
    </div>

    <!-- Assigned Wards Grid -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
            <span>👥</span>
            <span>Assigned Candidate Wards</span>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($links as $link)
                @php $ward = $link->seekerUser; @endphp
                <div class="p-5 rounded-2xl border border-amber-200/90 bg-amber-50/20 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-2xl overflow-hidden bg-gray-100 border border-amber-300">
                            <img src="{{ $ward->primary_photo_url }}" alt="{{ $ward->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-bold text-base text-gray-900">{{ $ward->name }}</h3>
                            <span class="text-xs text-amber-900 font-semibold block">
                                Relationship: {{ $link->relationship }} • Scope: {{ ucfirst(str_replace('_', ' ', $link->permission_scope)) }}
                            </span>
                            <span class="text-[11px] text-gray-500">
                                {{ $ward->age }} yrs • Gotra: {{ $ward->profile?->gotra ?? 'N/A' }} • {{ $ward->profile?->profession ?? 'Professional' }}
                            </span>
                        </div>
                    </div>

                    <a href="{{ route('profile.show', $ward->id) }}" class="px-3 py-2 rounded-xl border border-gray-300 text-xs font-bold text-gray-700 hover:bg-gray-50">
                        View Ward Biodata
                    </a>
                </div>
            @empty
                <div class="col-span-2 p-6 text-center text-xs text-gray-500">
                    No linked candidate wards assigned to your representative account yet.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Inbound Proposals Awaiting Elder Approval (FR-5.4, FR-7.2) -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>📥</span>
                <span>Inbound Matrimonial Proposals Awaiting Family Clearance ({{ $pendingProposals->count() }})</span>
            </h2>
            <span class="text-xs text-amber-800 font-semibold">Familial Consent Protocol Active</span>
        </div>

        @if($pendingProposals->isEmpty())
        <div class="p-8 text-center bg-amber-50/30 rounded-xl text-gray-500 text-xs">
            No pending proposals awaiting family review. All inbound requests are up to date.
        </div>
        @else
        <div class="space-y-4">
            @foreach($pendingProposals as $prop)
            <div class="p-6 rounded-2xl border-2 border-amber-200 bg-amber-50/20 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-2xl overflow-hidden bg-gray-100 border border-amber-300 shrink-0">
                            <img src="{{ $prop->sender->primary_photo_url }}" alt="{{ $prop->sender->name }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <h3 class="font-bold text-base text-gray-900">{{ $prop->sender->name }}</h3>
                                <span class="text-xs px-2 py-0.5 rounded-full bg-amber-100 text-amber-900 font-semibold border border-amber-300">
                                    Seeking: {{ $prop->receiver->name }}
                                </span>
                            </div>
                            <p class="text-xs text-amber-900 font-semibold mt-0.5">
                                {{ $prop->sender->age }} yrs • {{ $prop->sender->profile?->city ?? 'Location Open' }} • {{ $prop->sender->profile?->profession ?? 'Professional' }} • Gotra: {{ $prop->sender->profile?->gotra ?? 'N/A' }} ({{ $prop->sender->profile?->caste_jati ?? 'Hindu' }})
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('profile.show', $prop->sender->id) }}" class="px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-xs font-bold text-gray-700 self-start sm:self-center">
                        Inspect Suitor Biodata
                    </a>
                </div>

                <!-- Introductory message note -->
                <div class="p-3 bg-white rounded-xl border border-amber-100 text-xs text-gray-700 italic">
                    "{{ $prop->introductory_note }}"
                </div>

                <!-- Polite Response Macros (FR-5.4) -->
                <form method="POST" action="{{ route('family.proposal.handle', $prop->id) }}" class="space-y-3 pt-2 border-t border-amber-100">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">
                            Polite Family Response Macro Note:
                        </label>
                        <select name="family_rep_notes" class="w-full px-3 py-2 rounded-xl border border-gray-300 text-xs bg-white focus:ring-1 focus:ring-red-800">
                            <option value="Namaskar. Our family elders have reviewed your respected biodata and feel pleased to grant our blessings for your conversation.">
                                [Approval Macro] Blessings granted: We welcome initiating family conversation.
                            </option>
                            <option value="Pranam. We are honoured by your interest. Our family would be pleased to speak with your elders directly.">
                                [Approval Macro] Elder dialogue requested: Direct family phone call invited.
                            </option>
                            <option value="With utmost respect and goodwill to your esteemed family, our elders feel that our domestic and astrological horizons are not aligned at this time.">
                                [Decline Macro] Respectful decline: Wishing you success in finding your destined match.
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="submit" name="action" value="decline" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold">
                            ✕ Decline Proposal
                        </button>

                        <button type="submit" name="action" value="approve" class="px-5 py-2 rounded-xl gold-gradient text-white text-xs font-bold shadow hover:opacity-95 transition">
                            ✓ Approve Proposal with Blessings
                        </button>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Active Chaperoned Conversations Oversight -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
            <span>🛡️</span>
            <span>Chaperoned Conversation Oversight</span>
        </h2>

        <p class="text-xs text-gray-600">
            As an authorized Family Representative with oversight permissions, you maintain transparent supervisory visibility to protect familial dignity.
        </p>

        <div class="space-y-3">
            @php
                $wardIds = $links->pluck('seeker_user_id')->toArray();
            @endphp
            @foreach($acceptedProposals as $p)
            @php
                $suitor = in_array($p->sender_user_id, $wardIds) ? $p->receiver : $p->sender;
                $wardName = in_array($p->sender_user_id, $wardIds) ? $p->sender->name : $p->receiver->name;
            @endphp
            <div class="p-4 rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-between text-xs">
                <div>
                    <span class="font-bold text-gray-900">{{ $wardName }} (Your Ward)</span>
                    <span class="text-gray-400 mx-1.5">⇄</span>
                    <span class="font-bold text-gray-900">{{ $suitor->name }} (Suitor)</span>
                    <span class="text-[10px] text-emerald-700 font-semibold ml-2">Active Chaperoned Dialogue</span>
                </div>

                <a href="{{ route('chat.show', $suitor->id) }}" class="px-3.5 py-1.5 rounded-xl gold-gradient text-white font-bold text-xs shadow-xs hover:opacity-95 transition flex items-center gap-1.5">
                    <span>💬</span>
                    <span>Join Chaperone Messaging →</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

