<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commemorative Marriage Certificate - {{ $groom->name }} & {{ $bride->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f7f2e7;
            font-family: 'Playfair Display', serif;
        }
        .cert-border {
            border: 14px solid #800020;
            outline: 3px solid #d97706;
            outline-offset: -8px;
        }
        .font-cinzel {
            font-family: 'Cinzel', serif;
        }
        @media print {
            body { background: white; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="min-h-screen p-4 sm:p-12 flex flex-col items-center justify-center">

    <div class="no-print mb-6 flex space-x-4">
        <button onclick="window.print()" class="px-6 py-2.5 bg-red-900 text-amber-100 rounded-xl font-bold text-xs shadow hover:bg-red-800 transition">
            🖨️ Print / Save as PDF
        </button>
        <a href="{{ route('milestone.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-xl font-bold text-xs hover:bg-gray-50 transition">
            ← Return to Vivah Connect
        </a>
    </div>

    <!-- The Auspicious Certificate Canvas -->
    <div class="w-full max-w-4xl bg-[#fffdf7] cert-border p-8 sm:p-14 shadow-2xl relative overflow-hidden text-center text-gray-900">
        
        <!-- Corner Motifs -->
        <div class="absolute top-4 left-4 text-amber-700 text-2xl font-serif">✦</div>
        <div class="absolute top-4 right-4 text-amber-700 text-2xl font-serif">✦</div>
        <div class="absolute bottom-4 left-4 text-amber-700 text-2xl font-serif">✦</div>
        <div class="absolute bottom-4 right-4 text-amber-700 text-2xl font-serif">✦</div>

        <!-- Watermark -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.03]">
            <span class="text-[280px] font-cinzel text-red-950 font-black">VC</span>
        </div>

        <!-- Inscription Banner -->
        <div class="text-xs sm:text-sm text-amber-800 tracking-widest font-semibold uppercase mb-2">
            Sacred Matrimonial Covenant • Vivah Union Registry
        </div>

        <h1 class="font-cinzel font-black text-3xl sm:text-5xl text-red-950 tracking-wider mb-1 uppercase">
            Certificate of Vivah Union
        </h1>
        <div class="font-semibold text-lg sm:text-xl text-amber-900 mb-6 tracking-wide">
            Commemorating Sacred Matrimonial Solemnization
        </div>

        <div class="w-24 h-1 bg-gradient-to-r from-transparent via-amber-600 to-transparent mx-auto mb-6"></div>

        <p class="text-sm sm:text-base text-gray-700 max-w-2xl mx-auto leading-relaxed italic mb-8">
            This solemn certificate commemorates the sacred matrimonial union solemnized under traditional Vedic rites and mutual familial blessings between:
        </p>

        <!-- Groom & Bride Block -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 my-8 max-w-3xl mx-auto items-center">
            <!-- Groom -->
            <div class="p-6 rounded-2xl bg-amber-50/60 border border-amber-200/80">
                <span class="text-xs uppercase tracking-widest text-amber-800 font-bold block mb-1">Groom</span>
                <h2 class="font-cinzel font-bold text-2xl sm:text-3xl text-red-950">{{ $groom->name }}</h2>
                <p class="text-xs text-gray-600 mt-1">
                    Gotra Lineage: <strong>{{ $groomGotra }}</strong> • {{ $groom->profile?->city ?? 'Bangladesh' }}
                </p>
            </div>

            <!-- Bride -->
            <div class="p-6 rounded-2xl bg-amber-50/60 border border-amber-200/80">
                <span class="text-xs uppercase tracking-widest text-amber-800 font-bold block mb-1">Bride</span>
                <h2 class="font-cinzel font-bold text-2xl sm:text-3xl text-red-950">{{ $bride->name }}</h2>
                <p class="text-xs text-gray-600 mt-1">
                    Gotra Lineage: <strong>{{ $brideGotra }}</strong> • {{ $bride->profile?->city ?? 'Bangladesh' }}
                </p>
            </div>
        </div>

        <p class="text-xs sm:text-sm text-gray-700 max-w-xl mx-auto mb-10 leading-relaxed italic">
            "May their united lives forever shine with enduring affection, mutual respect, peace, and Dharmic fulfillment."
        </p>

        <!-- Footer Details -->
        <div class="pt-8 border-t border-amber-200/80 grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs text-gray-600 items-end">
            <div>
                <span class="block text-[10px] text-gray-400 uppercase font-bold">Wedding Date</span>
                <span class="font-bold text-gray-900 text-sm">{{ $weddingDate }}</span>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 rounded-full border-2 border-dashed border-amber-600 mx-auto flex items-center justify-center text-red-900 text-xs font-bold font-cinzel">
                    SEAL
                </div>
                <span class="text-[10px] text-amber-900 uppercase font-semibold mt-1 block">Vivah Connect Registry</span>
            </div>

            <div class="text-right">
                <span class="block text-[10px] text-gray-400 uppercase font-bold">Registry Certificate UUID</span>
                <span class="font-mono text-[10px] text-gray-700 block truncate">{{ $uuid }}</span>
            </div>
        </div>
    </div>
</body>
</html>
