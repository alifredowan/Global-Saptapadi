@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="relative section--dark rounded-2xl p-6 sm:p-8 text-white text-center overflow-hidden border border-[var(--color-accent)]/30 shadow-sm">
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs border border-white/20 text-white text-xs font-medium tracking-wide mb-3">
            <svg class="w-3.5 h-3.5 text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            <span>Quiet Family Trust &bull; Identity Verification</span>
        </div>
        <h1 class="font-serif font-bold text-2xl sm:text-3xl text-white tracking-tight">
            Verified Candidate Authentication
        </h1>
        <p class="text-xs sm:text-sm text-stone-200 mt-2 max-w-xl mx-auto leading-relaxed">
            When families connect on Global Saptapadi, they know every profile is authentic. Verification is confidential, reviewed by human trust officers, and encrypted at rest.
        </p>
    </div>

    <!-- Verification Status Banner -->
    @if($user->is_verified)
    <div class="p-5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-stone-800 dark:text-stone-200 flex items-center space-x-4 shadow-xs">
        <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
        </div>
        <div>
            <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Identity Successfully Verified</h3>
            <p class="text-xs text-stone-600 dark:text-stone-400 mt-0.5">
                Your government ID and live photo have been authenticated. Your biodata now displays the verified trust badge to families.
            </p>
        </div>
    </div>
    @elseif($verification && $verification->status === 'pending')
    <div class="p-5 rounded-2xl bg-amber-50/70 dark:bg-amber-950/30 border border-amber-200/80 dark:border-amber-900/50 text-stone-800 dark:text-stone-200 flex items-center space-x-4 shadow-xs">
        <div class="w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/40 text-[var(--color-accent)] flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <h3 class="font-serif font-bold text-base text-stone-900 dark:text-stone-100">Verification Under Review</h3>
            <p class="text-xs text-stone-600 dark:text-stone-400 mt-0.5">
                Our trust team is reviewing your documents. We typically finish within 24 to 48 hours.
            </p>
        </div>
    </div>
    @endif

    <!-- Upload KYC Form -->
    <div class="bg-white dark:bg-stone-900 rounded-2xl p-6 sm:p-8 border border-stone-200/90 dark:border-stone-800 shadow-xs space-y-5">
        <div>
            <h2 class="font-serif font-bold text-lg text-stone-900 dark:text-stone-100 flex items-center space-x-2">
                <svg class="w-5 h-5 text-[var(--color-primary)] dark:text-[var(--color-accent)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                <span>Submit Verification Documents</span>
            </h2>
            <p class="text-xs text-stone-500 dark:text-stone-400 mt-1">
                Your documents are encrypted with AES-256 and will never be shared with other candidates, families, or commercial third parties.
            </p>
        </div>

        <form method="POST" action="{{ route('verification.submit') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">Government ID Type</label>
                    <select name="id_type" required class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]">
                        <option value="passport">Passport (Machine Readable / e-Passport)</option>
                        <option value="national_id">National ID / Aadhaar / Voter ID</option>
                        <option value="driving_license">Driver's License</option>
                        <option value="voter_id">Electoral Identification Card</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">Document ID Number</label>
                    <input type="text" name="id_number" required placeholder="e.g. 1996123456789" class="w-full px-3 py-2 rounded-xl border border-stone-300 dark:border-stone-700 bg-white dark:bg-stone-800 text-stone-900 dark:text-stone-100 focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">1. Government Photo ID (Front)</label>
                    <input type="file" name="id_document" required accept="image/*,.pdf" class="w-full text-xs text-stone-600 dark:text-stone-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-medium file:bg-stone-100 dark:file:bg-stone-800 file:text-stone-800 dark:file:text-stone-200 hover:file:bg-stone-200">
                </div>

                <div>
                    <label class="block font-medium text-stone-700 dark:text-stone-300 mb-1">2. Live Selfie Photo</label>
                    <input type="file" name="selfie_document" required accept="image/*" class="w-full text-xs text-stone-600 dark:text-stone-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-medium file:bg-stone-100 dark:file:bg-stone-800 file:text-stone-800 dark:file:text-stone-200 hover:file:bg-stone-200">
                </div>
            </div>

            <div class="p-3.5 bg-amber-50/70 dark:bg-amber-950/20 rounded-xl border border-amber-200/80 dark:border-amber-900/50 text-[11px] text-stone-700 dark:text-stone-300 leading-relaxed">
                <strong class="font-medium text-stone-900 dark:text-stone-100">Privacy &amp; Data Protection:</strong> In accordance with global data protection standards (GDPR Art. 17 right to erasure), your uploaded documents are encrypted in transit and at rest. They are permanently purged from our servers if you delete your profile or request erasure.
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white font-medium text-xs shadow-xs transition cursor-pointer">
                Submit ID Verification
            </button>
        </form>
    </div>
</div>
@endsection
