<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kundli;
use App\Services\AstrologyService;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HoroscopeController extends Controller
{
    protected AstrologyService $astrologyService;

    public function __construct(AstrologyService $astrologyService)
    {
        $this->astrologyService = $astrologyService;
    }

    public function edit()
    {
        $user = Auth::user();
        $kundli = $user->kundli ?? Kundli::create(['user_id' => $user->id]);

        return view('horoscope.edit', [
            'kundli' => $kundli,
            'rashis' => array_keys(AstrologyService::RASHIS),
            'nakshatras' => AstrologyService::NAKSHATRAS,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $kundli = $user->kundli;

        $validated = $request->validate([
            'birth_date' => 'nullable|date',
            'birth_time' => 'nullable|string',
            'birth_place_city' => 'nullable|string',
            'birth_place_country' => 'nullable|string',
            'rashi' => 'nullable|string',
            'nakshatra' => 'nullable|string',
            'charan' => 'nullable|integer|min:1|max:4',
            'manglik_status' => 'required|in:non_manglik,manglik,anshik_manglik,unknown',
            'horoscope_opt_out' => 'nullable|boolean',
            'chart_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $validated['horoscope_opt_out'] = $request->boolean('horoscope_opt_out');

        if ($request->hasFile('chart_file')) {
            $file = $request->file('chart_file');
            $filename = 'kundli_' . $user->id . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kundli'), $filename);
            $validated['chart_file_path'] = 'uploads/kundli/' . $filename;
        }

        $kundli->update($validated);

        AuditLog::log('kundli_updated', [
            'rashi' => $kundli->rashi,
            'nakshatra' => $kundli->nakshatra,
            'opt_out' => $kundli->horoscope_opt_out,
        ], $user->id);

        return redirect()->route('horoscope.edit')->with('success', 'Horoscope details saved successfully.');
    }

    /**
     * Compute and view full 36-point Guna Milan breakdown and Manglik compatibility with a candidate.
     */
    public function compareWith($candidateId)
    {
        $viewer = Auth::user();
        $candidate = User::with(['kundli', 'profile'])->findOrFail($candidateId);

        $compatibility = $this->astrologyService->calculateOverallCompatibility($viewer, $candidate);

        return view('horoscope.compare', [
            'viewer' => $viewer,
            'candidate' => $candidate,
            'compatibility' => $compatibility,
        ]);
    }
}

