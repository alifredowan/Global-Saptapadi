@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-3xl p-6 sm:p-8 text-amber-100 shadow-md text-center">
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-2">
            <span>🪔</span>
            <span>Vivah Milestone & Lifecycle Closure</span>
        </div>
        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-amber-100">
            Shubho Bibaho Marriage Declaration
        </h1>
        <p class="text-xs sm:text-sm text-amber-200/80 mt-1 max-w-xl mx-auto leading-relaxed">
            Officially record your sacred marriage union, receive an auspicious digital commemorative certificate, and trigger respectful automated discovery de-indexing.
        </p>
    </div>

    <!-- Active Confirmed Milestone (if already declared) -->
    @if($milestone)
    <div class="bg-white rounded-3xl p-8 border-2 border-amber-300 shadow-xl text-center space-y-4">
        <div class="w-16 h-16 mx-auto rounded-full bg-amber-100 text-amber-800 flex items-center justify-center text-3xl">
            🪔
        </div>
        <h2 class="font-heading font-bold text-2xl text-red-950">Solemnized Vivah Union Confirmed</h2>
        <p class="text-sm text-gray-700">
            Sacred matrimonial union registered between <strong>{{ $milestone->spouseA->name }}</strong> and <strong>{{ $milestone->spouseB->name }}</strong>.
        </p>
        <p class="text-xs text-amber-900 font-semibold">
            Wedding Solemnized on: {{ $milestone->wedding_date->format('d/m/Y') }}
        </p>

        <div class="pt-4 flex justify-center space-x-4">
            <a href="{{ route('milestone.certificate', $milestone->certificate_uuid) }}" target="_blank" class="px-6 py-3 rounded-xl gold-gradient text-white text-xs font-bold shadow hover:opacity-95 transition flex items-center space-x-2">
                <span>📜</span>
                <span>View & Print Shubho Bibaho Certificate</span>
            </a>
        </div>
    </div>
    @else
    <!-- Marriage Declaration Form -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-amber-200 shadow-sm space-y-6">
        <h2 class="font-heading font-bold text-lg text-red-950 flex items-center space-x-2">
            <span>💍</span>
            <span>Declare Your Completed Vivah Union</span>
        </h2>
        <p class="text-xs text-gray-600">
            Declaring your marriage will generate your commemorative certificate, update your status to <strong>Married</strong>, and automatically close open proposals and third-party access in respect of your privacy.
        </p>

        <form method="POST" action="{{ route('milestone.declare') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Select Matrimonial Spouse</label>
                    <select name="spouse_id" required class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 bg-white">
                        <option value="">Select Spouse from Accepted Proposals</option>
                        @foreach($eligibleSpouses as $spouse)
                        <option value="{{ $spouse->id }}">{{ $spouse->name }} ({{ $spouse->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Wedding Solemnization Date (DD/MM/YYYY)</label>
                    <input type="date" name="wedding_date" required value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800">
                </div>
            </div>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1">Voluntary Success Story (FR-11.4)</label>
                <textarea name="success_story" rows="3" placeholder="Share your inspiring journey of how you connected on Vivah Connect to encourage future Dharmic seekers..." class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800"></textarea>
            </div>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1">Wedding Photograph (Voluntary)</label>
                <input type="file" name="wedding_photo" accept="image/*" class="w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:gold-gradient file:text-white hover:file:opacity-90">
            </div>

            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-950 text-xs space-y-2">
                <label class="flex items-start space-x-2 cursor-pointer">
                    <input type="checkbox" name="publish_story" value="1" class="mt-0.5 rounded text-red-900 focus:ring-red-800" checked>
                    <span>Allow publication of success story and wedding photo in Vivah Connect's community showcase.</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl gold-gradient text-white font-bold text-xs shadow hover:opacity-95 transition">
                Solemnize Vivah & Generate Shubho Bibaho Certificate
            </button>
        </form>
    </div>
    @endif
</div>
@endsection

