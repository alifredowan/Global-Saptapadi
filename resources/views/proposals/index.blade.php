@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center space-x-1.5 text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">
                <span>💌</span>
                <span>Formal Matrimonial Proposals & Approvals</span>
            </div>
            <h1 class="font-heading font-bold text-2xl text-gray-900">Proposals & Interests Workflow</h1>
        </div>

        <div class="text-right">
            <span class="text-xs text-gray-500 block">Daily Allowance:</span>
            <span class="font-extrabold text-sm {{ auth()->user()->isPro() ? 'text-emerald-700' : 'text-amber-800' }}">
                {{ auth()->user()->isPro() ? '✨ Pro Pass: Unlimited' : 'Free Explorer: Capped at 5/day' }}
            </span>
        </div>
    </div>

    <!-- Inbound Proposals -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-lg text-red-950 flex items-center space-x-2">
            <span>📥</span>
            <span>Inbound Interests Received ({{ $inboundProposals->count() }})</span>
        </h2>

        @if($inboundProposals->isEmpty())
        <div class="p-8 text-center bg-amber-50/30 rounded-xl text-gray-500 text-xs">
            No inbound matrimonial proposals received yet. Completed biodatas with verified horoscopes receive more proposals!
        </div>
        @else
        <div class="space-y-4">
            @foreach($inboundProposals as $prop)
            <div class="p-5 rounded-2xl border border-amber-200/80 bg-amber-50/20 hover:bg-amber-50/40 transition flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-start space-x-4">
                    <div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden border border-amber-200 shrink-0">
                        <img src="{{ $prop->sender->primary_photo_url }}" alt="{{ $prop->sender->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="font-bold text-base text-gray-900">{{ $prop->sender->name }}</h3>
                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold {{ $prop->status === 'accepted' ? 'bg-emerald-100 text-emerald-800' : ($prop->status === 'declined' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-900') }}">
                                {{ ucfirst(str_replace('_', ' ', $prop->status)) }}
                            </span>
                        </div>
                        <p class="text-xs text-amber-900 font-medium mt-0.5">
                            {{ $prop->sender->age }} yrs • {{ $prop->sender->profile?->city ?? 'Location Open' }} • {{ $prop->sender->profile?->profession ?? 'Professional' }} • Gotra: {{ $prop->sender->profile?->gotra ?? 'N/A' }}
                        </p>
                        <p class="text-xs text-gray-600 mt-2 italic bg-white/70 p-2.5 rounded-lg border border-amber-100">
                            "{{ $prop->introductory_note ?? 'Interested in connecting.' }}"
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-2 shrink-0 self-end sm:self-center">
                    <a href="{{ route('profile.show', $prop->sender->id) }}" class="px-3 py-2 rounded-xl border border-gray-300 text-xs font-bold text-gray-700 hover:bg-gray-100">
                        View Biodata
                    </a>

                    @if($prop->status === 'pending' || $prop->status === 'routed_to_family')
                    <form method="POST" action="{{ route('proposals.accept', $prop->id) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-xl gold-gradient text-white text-xs font-bold shadow hover:opacity-95 transition">
                            ✓ Accept Proposal
                        </button>
                    </form>

                    <form method="POST" action="{{ route('proposals.decline', $prop->id) }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold">
                            ✕ Decline
                        </button>
                    </form>
                    @elseif($prop->status === 'accepted')
                    <a href="{{ route('chat.show', $prop->sender->id) }}" class="px-4 py-2 rounded-xl gold-gradient text-white text-xs font-bold shadow hover:opacity-95 transition">
                        💬 Open Chat
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Outbound Proposals -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-lg text-red-950 flex items-center space-x-2">
            <span>📤</span>
            <span>Outbound Proposals Sent ({{ $outboundProposals->count() }})</span>
        </h2>

        @if($outboundProposals->isEmpty())
        <div class="p-8 text-center bg-amber-50/30 rounded-xl text-gray-500 text-xs">
            You haven't transmitted any formal proposals yet. Browse candidates in Discovery to initiate connection!
        </div>
        @else
        <div class="space-y-4">
            @foreach($outboundProposals as $prop)
            <div class="p-5 rounded-2xl border border-gray-200 bg-white hover:bg-gray-50/60 transition flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden border border-gray-200 shrink-0">
                        <img src="{{ $prop->receiver->primary_photo_url }}" alt="{{ $prop->receiver->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="font-bold text-sm text-gray-900">{{ $prop->receiver->name }}</h3>
                            <span class="text-[11px] px-2 py-0.5 rounded-full font-semibold {{ $prop->status === 'accepted' ? 'bg-emerald-100 text-emerald-800' : ($prop->status === 'declined' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-900') }}">
                                {{ ucfirst(str_replace('_', ' ', $prop->status)) }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Sent on {{ $prop->created_at->format('d/m/Y') }} • {{ $prop->receiver->profile?->city ?? 'Location Open' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <a href="{{ route('profile.show', $prop->receiver->id) }}" class="px-3 py-1.5 rounded-xl border border-gray-300 text-xs font-semibold text-gray-700 hover:bg-gray-100">
                        View Biodata
                    </a>
                    @if($prop->status === 'accepted')
                    <a href="{{ route('chat.show', $prop->receiver->id) }}" class="px-4 py-1.5 rounded-xl gold-gradient text-white text-xs font-bold shadow hover:opacity-95">
                        💬 Open Chat
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection

