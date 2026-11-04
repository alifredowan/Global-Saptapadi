@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-red-950 via-red-900 to-amber-900 rounded-3xl p-6 sm:p-8 text-amber-100 shadow-md">
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-semibold uppercase tracking-wider mb-2">
            <span>🛡️</span>
            <span>Trust & Verification Shield</span>
        </div>
        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-amber-100">
            "Verified Seeker" Authentication
        </h1>
        <p class="text-xs text-amber-200/80 mt-1 leading-relaxed">
            Eliminating catfish profiles, casual daters, and bad actors. Authentic Hindu matrimonial platform powered by encrypted government ID & live selfie audit.
        </p>
    </div>

    <!-- Verification Status Banner -->
    @if($user->is_verified)
    <div class="p-6 rounded-2xl bg-emerald-50 border-2 border-emerald-300 text-emerald-950 flex items-center space-x-4 shadow-sm">
        <div class="w-14 h-14 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-3xl font-bold shrink-0">
            ✓
        </div>
        <div>
            <h3 class="font-bold text-base text-emerald-900">Verified Seeker Trust Badge Active</h3>
            <p class="text-xs text-emerald-800 mt-0.5">
                Your government identity and live selfie have been successfully reviewed and authenticated. Your biodata carries the verified green trust crest.
            </p>
        </div>
    </div>
    @elseif($verification && $verification->status === 'pending')
    <div class="p-6 rounded-2xl bg-amber-50 border-2 border-amber-300 text-amber-950 flex items-center space-x-4 shadow-sm">
        <div class="w-14 h-14 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center text-2xl font-bold shrink-0">
            ⏳
        </div>
        <div>
            <h3 class="font-bold text-base text-amber-900">KYC Documents Under Review (24-48 Hours)</h3>
            <p class="text-xs text-amber-800 mt-0.5">
                Your document submission is currently being reviewed by our Trust & Verification officers.
            </p>
        </div>
    </div>
    @endif

    <!-- Upload KYC Form -->
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-amber-200 shadow-sm space-y-4">
        <h2 class="font-heading font-bold text-base text-red-950 flex items-center space-x-2">
            <span>📜</span>
            <span>Submit Verification Artifacts</span>
        </h2>
        <p class="text-xs text-gray-500">
            Documents are encrypted at rest with AES-256 and never shared with other users or commercial third parties.
        </p>

        <form method="POST" action="{{ route('verification.submit') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Government ID Type</label>
                    <select name="id_type" required class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800 bg-white">
                        <option value="national_id">National ID Card (NID / Smart Card / Aadhaar)</option>
                        <option value="passport">International Passport</option>
                        <option value="voter_id">Voter Identification Card</option>
                        <option value="driving_license">Driving License</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">Document Identification Number</label>
                    <input type="text" name="id_number" required placeholder="e.g. 1996123456789" class="w-full px-3 py-2 rounded-xl border border-gray-300 focus:ring-1 focus:ring-red-800">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">1. Government Photo ID Document (Front)</label>
                    <input type="file" name="id_document" required accept="image/*,.pdf" class="w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:gold-gradient file:text-white hover:file:opacity-90">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 uppercase mb-1">2. Live Selfie Photograph</label>
                    <input type="file" name="selfie_document" required accept="image/*" class="w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:gold-gradient file:text-white hover:file:opacity-90">
                </div>
            </div>

            <div class="p-3 bg-amber-50 rounded-xl border border-amber-200 text-[11px] text-amber-900">
                🛡️ <strong>Statutory Privacy Protection:</strong> Under the DPDP Act 2023 and Bangladesh privacy rules, submitted biometric artifacts are purely utilized for identity verification and permanently purged upon account erasure request.
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl gold-gradient text-white font-bold text-xs shadow hover:opacity-95 transition">
                Submit ID Verification
            </button>
        </form>
    </div>
</div>
@endsection

