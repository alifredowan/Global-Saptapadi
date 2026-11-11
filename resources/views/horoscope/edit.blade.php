@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header Card -->
    <div class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)]">
        <div class="space-y-1">
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-[var(--radius-xs)] bg-[var(--secondary-subtle)] border border-[var(--secondary-border)] text-[var(--secondary-text)] text-[11px] font-semibold uppercase tracking-wider mb-1">
                <span>Vedic Astrology</span>
            </div>
            <h1 class="font-serif font-bold text-2xl text-[var(--text-primary)]">
                Janam Patrika &amp; Horoscope Details
            </h1>
            <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                Add your birth chart details for 36-Point Ashtakoota Guna Milan, or opt out if your family does not observe horoscope matching.
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('horoscope.update') }}" enctype="multipart/form-data" class="card-ledger p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] space-y-6">
        @csrf

        <!-- Astrology Opt-Out Option -->
        <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-subtle)] flex items-start space-x-3 text-xs">
            <input type="checkbox" name="horoscope_opt_out" id="horoscope_opt_out" value="1" {{ $kundli->horoscope_opt_out ? 'checked' : '' }} class="mt-0.5 rounded-[var(--radius-xs)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)] cursor-pointer">
            <div>
                <label for="horoscope_opt_out" class="font-semibold text-sm text-[var(--text-primary)] cursor-pointer">
                    Horoscope matching is not required
                </label>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5 leading-relaxed">
                    Check this if you or your family do not observe horoscope matching. Compatibility will be calculated based on family values, education, and lifestyle.
                </p>
            </div>
        </div>

        <!-- Natal Birth Parameters -->
        <div class="space-y-4">
            <div class="pb-2 border-b border-[var(--border-subtle)]">
                <h2 class="font-serif font-bold text-base text-[var(--text-primary)] flex items-center gap-2">
                    <svg class="w-4 h-4 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <span>Birth Details</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Date of Birth</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $kundli->birth_date ? $kundli->birth_date->format('Y-m-d') : '') }}" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Time of Birth</label>
                    <input type="text" name="birth_time" value="{{ old('birth_time', $kundli->birth_time ?? '07:30') }}" placeholder="e.g. 07:30 AM or 18:45" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Place of Birth (City)</label>
                    <input type="text" name="birth_place_city" value="{{ old('birth_place_city', $kundli->birth_place_city) }}" placeholder="e.g. London, Toronto, Dubai, Houston, Kolkata, Dhaka" class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Country of Birth</label>
                    <input type="text" name="birth_place_country" value="{{ old('birth_place_country', $kundli->birth_place_country ?? 'United States') }}" placeholder="e.g. United Kingdom, USA, Canada, UAE, India, Bangladesh, Nepal" class="w-full px-3 py-2.5 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                </div>
            </div>
        </div>

        <!-- Astrological Coordinates -->
        <div class="space-y-4 pt-4 border-t border-[var(--border-subtle)]">
            <div class="pb-2 border-b border-[var(--border-subtle)]">
                <h2 class="font-serif font-bold text-base text-[var(--text-primary)] flex items-center gap-2">
                    <svg class="w-4 h-4 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3a14.5 14.5 0 0 0 0 18M12 3a14.5 14.5 0 0 1 0 18M3 12h18"/></svg>
                    <span>Rashi, Nakshatra &amp; Manglik Status</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Rashi (Moon Sign)</label>
                    <select name="rashi" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Select Rashi</option>
                        @foreach($rashis as $r)
                        <option value="{{ $r }}" {{ old('rashi', $kundli->rashi) == $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Nakshatra (Birth Star)</label>
                    <select name="nakshatra" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="">Select Nakshatra</option>
                        @foreach($nakshatras as $nak)
                        <option value="{{ $nak }}" {{ old('nakshatra', $kundli->nakshatra) == $nak ? 'selected' : '' }}>{{ $nak }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1">Pada / Charan</label>
                    <select name="charan" class="w-full px-3 py-2 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none text-xs">
                        <option value="1" {{ old('charan', $kundli->charan) == 1 ? 'selected' : '' }}>Charan 1</option>
                        <option value="2" {{ old('charan', $kundli->charan) == 2 ? 'selected' : '' }}>Charan 2</option>
                        <option value="3" {{ old('charan', $kundli->charan) == 3 ? 'selected' : '' }}>Charan 3</option>
                        <option value="4" {{ old('charan', $kundli->charan) == 4 ? 'selected' : '' }}>Charan 4</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-semibold text-[var(--text-secondary)] uppercase text-[10px] tracking-wider mb-1.5">
                    Mangal Dosha / Manglik Status
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                    <label class="flex items-center space-x-2 p-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] cursor-pointer hover:bg-[var(--bg-subtle)]">
                        <input type="radio" name="manglik_status" value="non_manglik" {{ old('manglik_status', $kundli->manglik_status) == 'non_manglik' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="font-medium text-[var(--color-success)]">Non-Manglik</span>
                    </label>

                    <label class="flex items-center space-x-2 p-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] cursor-pointer hover:bg-[var(--bg-subtle)]">
                        <input type="radio" name="manglik_status" value="manglik" {{ old('manglik_status', $kundli->manglik_status) == 'manglik' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="font-medium text-[var(--secondary-text)]">Manglik</span>
                    </label>

                    <label class="flex items-center space-x-2 p-3 rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] cursor-pointer hover:bg-[var(--bg-subtle)]">
                        <input type="radio" name="manglik_status" value="anshik_manglik" {{ old('manglik_status', $kundli->manglik_status) == 'anshik_manglik' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span class="font-medium text-[var(--text-primary)]">Anshik (Partial)</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Kundli Chart Document Upload -->
        <div class="space-y-3 pt-4 border-t border-[var(--border-subtle)]">
            <h2 class="font-serif font-bold text-base text-[var(--text-primary)] flex items-center gap-2">
                <svg class="w-4 h-4 text-[var(--secondary-primary)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                <span>Patrika Document Upload (Optional)</span>
            </h2>
            <p class="text-xs text-[var(--text-muted)] leading-relaxed">
                Upload your family astrologer's prepared Kundli chart (PDF or image). Revealed only to accepted proposals.
            </p>

            <input type="file" name="chart_file" accept=".pdf,image/*" class="w-full text-xs text-[var(--text-secondary)] file:mr-3 file:py-1.5 file:px-3 file:rounded-[var(--radius-sm)] file:border-0 file:text-xs file:font-semibold file:btn-secondary cursor-pointer">

            @if($kundli->chart_file_path)
            <div class="p-3 bg-[var(--color-success-bg)] border border-[var(--color-success-border)] rounded-[var(--radius-sm)] flex items-center justify-between text-xs text-[var(--color-success)]">
                <span class="font-medium">Attached Chart: {{ basename($kundli->chart_file_path) }}</span>
                <span class="text-[11px] font-semibold">Protected</span>
            </div>
            @endif
        </div>

        <button type="submit" class="btn-primary w-full text-xs font-semibold !min-h-[42px]">
            Save Horoscope Details
        </button>
    </form>
</div>
@endsection
