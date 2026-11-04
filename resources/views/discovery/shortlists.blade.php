@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm flex items-center justify-between">
        <div>
            <div class="inline-flex items-center space-x-1.5 text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">
                <span>⭐</span>
                <span>Private Candidate Repository</span>
            </div>
            <h1 class="font-heading font-bold text-2xl text-gray-900">Confidential Shortlists & Notes</h1>
        </div>
        <a href="{{ route('discovery.index') }}" class="px-4 py-2 rounded-xl gold-gradient text-white text-xs font-bold shadow">
            Discover More Matches →
        </a>
    </div>

    <!-- Shortlist items -->
    <div class="space-y-4">
        @forelse($shortlists as $item)
            @php $candidate = $item->candidate; @endphp
            <div class="bg-white rounded-2xl p-5 border border-amber-200 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-gray-100 overflow-hidden border border-amber-200 shrink-0">
                        <img src="{{ $candidate->primary_photo_url }}" alt="{{ $candidate->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="font-bold text-base text-gray-900">{{ $candidate->name }}</h3>
                            <span class="text-xs text-amber-900 font-semibold">{{ $candidate->age }} yrs</span>
                        </div>
                        <p class="text-xs text-gray-500">
                            {{ $candidate->profile?->city ?? 'Location Open' }} • Gotra: {{ $candidate->profile?->gotra ?? 'N/A' }} • {{ $candidate->profile?->profession ?? 'Professional' }}
                        </p>
                        @if($item->confidential_notes)
                        <div class="mt-2 text-xs bg-amber-50 p-2.5 rounded-xl border border-amber-200 text-amber-950">
                            <span class="font-bold text-[10px] uppercase text-amber-800 block">Private Notes:</span>
                            {{ $item->confidential_notes }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-2 shrink-0">
                    <a href="{{ route('profile.show', $candidate->id) }}" class="px-4 py-2 rounded-xl border border-gray-300 text-xs font-bold text-gray-700 hover:bg-gray-50">
                        Inspect Biodata
                    </a>
                    <form method="POST" action="{{ route('shortlist.toggle', $candidate->id) }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-xl bg-red-50 text-red-800 hover:bg-red-100 text-xs font-bold">
                            Remove
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl p-12 text-center border border-amber-200 text-xs text-gray-500">
                You haven't shortlisted any candidates yet. Click the star icon on candidate cards to curate your private repository.
            </div>
        @endforelse
    </div>
</div>
@endsection

