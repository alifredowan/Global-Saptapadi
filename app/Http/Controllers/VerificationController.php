<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentityVerification;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $verification = $user->identityVerification;

        return view('verification.index', compact('user', 'verification'));
    }

    public function submit(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'id_type' => 'required|in:national_id,passport,voter_id,driving_license',
            'id_number' => 'required|string|max:100',
            'id_document' => 'required|file|mimes:jpeg,png,jpg,pdf|max:10240',
            'selfie_document' => 'required|file|mimes:jpeg,png,jpg|max:10240',
        ]);

        $uploadDir = public_path('uploads/kyc');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $idFilename = 'id_' . $user->id . '_' . Str::random(12) . '.' . $request->file('id_document')->getClientOriginalExtension();
        $request->file('id_document')->move($uploadDir, $idFilename);

        $selfieFilename = 'selfie_' . $user->id . '_' . Str::random(12) . '.' . $request->file('selfie_document')->getClientOriginalExtension();
        $request->file('selfie_document')->move($uploadDir, $selfieFilename);

        IdentityVerification::updateOrCreate(
            ['user_id' => $user->id],
            [
                'id_type' => $validated['id_type'],
                'id_number' => $validated['id_number'],
                'id_document_path' => 'uploads/kyc/' . $idFilename,
                'selfie_document_path' => 'uploads/kyc/' . $selfieFilename,
                'status' => 'pending',
                'rejection_reason' => null,
            ]
        );

        AuditLog::log('kyc_documents_submitted', ['id_type' => $validated['id_type']], $user->id);

        return back()->with('success', 'Government ID and live selfie submitted for Trust & Verification review. Typically approved within 24-48 hours.');
    }
}

