<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commemorative Marriage Certificate &bull; {{ $groom->name }} &amp; {{ $bride->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;0,700;1,600&family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #FFFBF3;
            color: #1A1A1A;
            font-family: 'DM Sans', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .font-serif {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }
        .action-bar {
            margin-bottom: 1.5rem;
            display: flex;
            gap: 0.75rem;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 180ms ease-out;
        }
        .btn-print {
            background-color: #8B1E2D;
            color: #ffffff;
            border: 1px solid #8B1E2D;
        }
        .btn-print:hover {
            background-color: #6E1723;
        }
        .btn-back {
            background-color: #ffffff;
            color: #44403C;
            border: 1px solid #D6D3D1;
        }
        .btn-back:hover {
            background-color: #F5F5F4;
        }
        .certificate-canvas {
            width: 100%;
            max-width: 820px;
            background-color: #FFFFFF;
            border: 2px solid #E07B1A;
            outline: 6px solid #8B1E2D;
            outline-offset: -10px;
            padding: 3.5rem 3rem;
            position: relative;
            box-shadow: 0 10px 30px -10px rgba(139, 30, 45, 0.12);
            text-align: center;
        }
        .corner-ornament {
            position: absolute;
            width: 24px;
            height: 24px;
            color: #E07B1A;
        }
        .corner-tl { top: 16px; left: 16px; }
        .corner-tr { top: 16px; right: 16px; transform: scaleX(-1); }
        .corner-bl { bottom: 16px; left: 16px; transform: scaleY(-1); }
        .corner-br { bottom: 16px; right: 16px; transform: scale(-1); }
        .sub-header {
            font-size: 0.6875rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #E07B1A;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .cert-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #8B1E2D;
            letter-spacing: -0.01em;
            line-height: 1.15;
            margin-bottom: 0.25rem;
        }
        .cert-subtitle {
            font-size: 1rem;
            color: #E07B1A;
            margin-bottom: 1.5rem;
        }
        .divider {
            width: 80px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #E07B1A, transparent);
            margin: 0 auto 1.75rem;
        }
        .lead-text {
            font-size: 0.9375rem;
            color: #57534E;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto 2rem;
            font-style: italic;
        }
        .couple-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .couple-card {
            background-color: #FFFBF3;
            border: 1px solid #EADFCB;
            border-radius: 1rem;
            padding: 1.5rem;
        }
        .couple-role {
            font-size: 0.6875rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #E07B1A;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .couple-name {
            font-size: 1.625rem;
            font-weight: 700;
            color: #8B1E2D;
            margin-bottom: 0.25rem;
        }
        .couple-meta {
            font-size: 0.75rem;
            color: #57534E;
        }
        .blessing-quote {
            font-size: 0.875rem;
            color: #78716C;
            font-style: italic;
            max-width: 520px;
            margin: 0 auto 2.5rem;
            line-height: 1.5;
        }
        .cert-footer {
            border-top: 1px solid #EADFCB;
            padding-top: 1.5rem;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
            font-size: 0.75rem;
            color: #78716C;
        }
        .seal-box {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .seal-circle {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 1.5px dashed #E07B1A;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8B1E2D;
            font-weight: 700;
            font-size: 0.6875rem;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }
        @media (max-width: 640px) {
            .certificate-canvas { padding: 2rem 1.5rem; }
            .couple-grid { grid-template-columns: 1fr; gap: 1rem; }
            .cert-footer { grid-template-columns: 1fr; gap: 1rem; text-align: center !important; }
            .cert-footer > div:last-child { text-align: center !important; }
        }
        @media print {
            body { background: #ffffff; padding: 0; }
            .no-print { display: none !important; }
            .certificate-canvas {
                box-shadow: none;
                border-width: 2px;
                outline-width: 5px;
                max-width: 100%;
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="action-bar no-print">
        <button onclick="window.print()" class="btn btn-print">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24-1.076-.672-2.14-1.296-3.111A9.972 9.972 0 0012 3a9.972 9.972 0 006.576 7.718c-.624.97-1.056 2.035-1.296 3.111M6.75 18h10.5M6 21h12a1.5 1.5 0 001.5-1.5v-4.5A1.5 1.5 0 0018 13.5H6a1.5 1.5 0 00-1.5 1.5v4.5A1.5 1.5 0 006 21z"/></svg>
            <span>Print or Save as PDF</span>
        </button>
        <a href="{{ route('milestone.index') }}" class="btn btn-back">
            <span>&larr; Return to Dashboard</span>
        </a>
    </div>

    <!-- The Auspicious Certificate Canvas -->
    <div class="certificate-canvas">
        
        <!-- Corner Ornaments (Hand-drawn Alpona L-stroke style) -->
        <svg class="corner-ornament corner-tl" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 15V5a2 2 0 012-2h10M3 3l6 6"/></svg>
        <svg class="corner-ornament corner-tr" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 15V5a2 2 0 012-2h10M3 3l6 6"/></svg>
        <svg class="corner-ornament corner-bl" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 15V5a2 2 0 012-2h10M3 3l6 6"/></svg>
        <svg class="corner-ornament corner-br" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 15V5a2 2 0 012-2h10M3 3l6 6"/></svg>

        <div class="sub-header">
            Sacred Matrimonial Covenant &bull; Saptapadi Milestone Registry
        </div>

        <h1 class="font-serif cert-title">
            Certificate of Vivah Union
        </h1>
        <div class="font-serif cert-subtitle">
            Commemorating Sacred Matrimonial Solemnization
        </div>

        <div class="divider"></div>

        <p class="font-serif lead-text">
            This solemn certificate commemorates the sacred matrimonial union solemnized under traditional Vedic rites and mutual familial blessings between:
        </p>

        <!-- Groom & Bride Block -->
        <div class="couple-grid">
            <!-- Groom -->
            <div class="couple-card">
                <div class="couple-role">Groom</div>
                <h2 class="font-serif couple-name">{{ $groom->name }}</h2>
                <p class="couple-meta">
                    Gotra: <strong>{{ $groomGotra }}</strong> &bull; {{ $groom->profile?->city ?? 'Global' }}@if($groom->profile?->country), {{ $groom->profile->country }}@endif
                </p>
            </div>

            <!-- Bride -->
            <div class="couple-card">
                <div class="couple-role">Bride</div>
                <h2 class="font-serif couple-name">{{ $bride->name }}</h2>
                <p class="couple-meta">
                    Gotra: <strong>{{ $brideGotra }}</strong> &bull; {{ $bride->profile?->city ?? 'Global' }}@if($bride->profile?->country), {{ $bride->profile->country }}@endif
                </p>
            </div>
        </div>

        <p class="font-serif blessing-quote">
            &ldquo;Seven steps taken together around the sacred fire. May their united lives forever shine with enduring affection, mutual respect, peace, and Dharmic fulfillment.&rdquo;
        </p>

        <!-- Footer Details -->
        <div class="cert-footer">
            <div style="text-align: left;">
                <span style="display: block; font-size: 0.625rem; text-transform: uppercase; color: #A8A29E; font-weight: 700;">Solemnization Date</span>
                <strong style="color: #1F1917; font-size: 0.875rem;">{{ $weddingDate }}</strong>
            </div>

            <div class="seal-box">
                <div class="seal-circle font-serif">
                    SEAL
                </div>
                <span style="font-size: 0.625rem; color: #E07B1A; text-transform: uppercase; font-weight: 600;">Global Saptapadi Registry</span>
            </div>

            <div style="text-align: right;">
                <span style="display: block; font-size: 0.625rem; text-transform: uppercase; color: #A8A29E; font-weight: 700;">Registry UUID</span>
                <span style="font-family: monospace; font-size: 0.6875rem; color: #57534E;">{{ $uuid }}</span>
            </div>
        </div>
    </div>
</body>
</html>
