@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-2xl p-6 sm:p-8 text-amber-100 shadow-md">
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-2">
            <span>🪐</span>
            <span>Vedic Horoscope & Kundli Management</span>
        </div>
        <h1 class="font-heading font-bold text-2xl text-amber-100">
            Janam Patrika & Astrological Profiling
        </h1>
        <p class="text-xs text-amber-200/80 mt-1 leading-relaxed">
            Automated 36-point Ashtakoota Guna Milan, Rashi, Nakshatra, and Manglik alignment with permission-gated chart storage.
        </p>
    </div>

    <form method="POST" action="{{ route('horoscope.update') }}" enctype="multipart/form-data" class="bg-white rounded-2xl p-6 sm:p-8 border border-amber-200 shadow-sm space-y-6">
        @csrf

        <!-- Astrology Opt-Out Toggle (FR-3.5) -->
        <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 flex items-start space-x-3">
            <input type="checkbox" name="horoscope_opt_out" id="horoscope_opt_out" value="1" {{ $kundli->horoscope_opt_out ? 'checked' : '' }} class="mt-1 rounded text-red-900 focus:ring-red-800">
            <div>
                <label for="horoscope_opt_out" class="font-bold text-sm text-amber-950 cursor-pointer">
                    Horoscope Not Required (Bypass Astrological Scoring)
                </label>
                <p class="text-xs text-gray-600 mt-0.5">
                    Select this option if you or your family do not observe horoscope matching. Compatibility will be calculated based on family values, education, and lifestyle.
                </p>
            </div>
        </div>

        <!-- Natal Birth Parameters (FR-3.1) -->
        <div class="space-y-4">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>📍</span>
                <span>Natal Birth Data</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Date of Birth (DD/MM/YYYY)</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $kundli->birth_date ? $kundli->birth_date->format('Y-m-d') : '') }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Exact Time of Birth (hh:mm)</label>
                    <input type="text" name="birth_time" value="{{ old('birth_time', $kundli->birth_time ?? '07:30') }}" placeholder="e.g. 07:30 AM or 18:45" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">City / Place of Birth</label>
                    <input type="text" name="birth_place_city" value="{{ old('birth_place_city', $kundli->birth_place_city) }}" placeholder="e.g. Dhaka, Kolkata, Sylhet" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Country of Birth</label>
                    <input type="text" name="birth_place_country" value="{{ old('birth_place_country', $kundli->birth_place_country ?? 'Bangladesh') }}" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs">
                </div>
            </div>
        </div>

        <!-- Astrological Coordinates & Overrides (FR-3.1, FR-3.4) -->
        <div class="space-y-4 pt-4 border-t border-gray-100">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>✨</span>
                <span>Rashi, Nakshatra & Manglik Placement</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Rashi (Moon Sign)</label>
                    <select name="rashi" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="">Select Rashi</option>
                        @foreach($rashis as $r)
                        <option value="{{ $r }}" {{ old('rashi', $kundli->rashi) == $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Nakshatra (Birth Star)</label>
                    <select name="nakshatra" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="">Select Nakshatra</option>
                        @foreach($nakshatras as $nak)
                        <option value="{{ $nak }}" {{ old('nakshatra', $kundli->nakshatra) == $nak ? 'selected' : '' }}>{{ $nak }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Pada / Charan</label>
                    <select name="charan" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 text-xs bg-white">
                        <option value="1" {{ old('charan', $kundli->charan) == 1 ? 'selected' : '' }}>Charan 1</option>
                        <option value="2" {{ old('charan', $kundli->charan) == 2 ? 'selected' : '' }}>Charan 2</option>
                        <option value="3" {{ old('charan', $kundli->charan) == 3 ? 'selected' : '' }}>Charan 3</option>
                        <option value="4" {{ old('charan', $kundli->charan) == 4 ? 'selected' : '' }}>Charan 4</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-bold text-gray-700 uppercase mb-1 text-xs">
                    Mangal Dosha / Manglik Status (FR-3.4)
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                    <label class="flex items-center space-x-2 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-amber-50/50">
                        <input type="radio" name="manglik_status" value="non_manglik" {{ old('manglik_status', $kundli->manglik_status) == 'non_manglik' ? 'checked' : '' }} class="text-red-900">
                        <span class="font-semibold text-emerald-800">Non-Manglik</span>
                    </label>

                    <label class="flex items-center space-x-2 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-amber-50/50">
                        <input type="radio" name="manglik_status" value="manglik" {{ old('manglik_status', $kundli->manglik_status) == 'manglik' ? 'checked' : '' }} class="text-red-900">
                        <span class="font-semibold text-amber-800">Manglik</span>
                    </label>

                    <label class="flex items-center space-x-2 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-amber-50/50">
                        <input type="radio" name="manglik_status" value="anshik_manglik" {{ old('manglik_status', $kundli->manglik_status) == 'anshik_manglik' ? 'checked' : '' }} class="text-red-900">
                        <span class="font-semibold text-amber-900">Anshik Manglik (Partial)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Physical Kundli Chart Document Upload (FR-3.2) -->
        <div class="space-y-3 pt-4 border-t border-gray-100">
            <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
                <span>📜</span>
                <span>Physical Janam Patrika Document (Permission-Gated)</span>
            </h2>
            <p class="text-xs text-gray-500">
                Upload your family astrologer's prepared Kundli chart (PDF or high-res image). Encrypted and revealed only upon your explicit authorization.
            </p>

            <input type="file" name="chart_file" accept=".pdf,image/*" class="w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:gold-gradient file:text-white hover:file:opacity-90">

            @if($kundli->chart_file_path)
            <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between text-xs text-emerald-900">
                <span class="font-semibold">✓ Physical Kundli Chart Attached: {{ basename($kundli->chart_file_path) }}</span>
                <span class="text-[11px] font-bold text-emerald-700">Protected Storage</span>
            </div>
            @endif
        </div>

        <button type="submit" class="w-full py-3.5 rounded-xl gold-gradient text-white font-bold text-sm shadow hover:opacity-95 transition">
            Save Astrological Settings
        </button>
    </form>
</div>
@endsection

