<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Models\Profile;
use App\Models\Kundli;
use App\Models\PartnerPreference;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status === 'banned' || $user->status === 'suspended') {
                Auth::logout();
                return back()->withErrors(['email' => 'This account has been restricted due to community ethics policy violations.']);
            }

            AuditLog::log('user_logged_in', ['email' => $user->email], $user->id);

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        // Set role based on gender if seeker
        $dob = Carbon::parse($validated['date_of_birth']);
        $age = $dob->age;

        $role = $validated['role'];
        if ($role !== 'family_rep') {
            $role = ($validated['gender'] === 'male') ? 'groom' : 'bride';
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'date_of_birth' => $validated['date_of_birth'],
            'role' => $role,
            'profile_managed_by' => $validated['profile_managed_by'],
            'marital_status' => $validated['marital_status'],
            'password' => Hash::make($validated['password']),
            'is_verified' => false,
            'membership_tier' => 'free',
            'status' => 'active',
            'anti_bot_verified' => true,
            'email_verified_at' => now(), // Simulated dual-channel confirmation
            'phone_verified_at' => now(),
        ]);

        // Create default Profile
        // Default photo privacy: Blurred until mutual for female candidates, Public for male candidates (URS FR-4.2 & Concept Matrix)
        $defaultPhotoPrivacy = ($user->gender === 'female') ? 'blur_until_mutual' : 'public';

        Profile::create([
            'user_id' => $user->id,
            'religion' => 'Hindu',
            'caste_no_bar' => true,
            'photo_privacy' => $defaultPhotoPrivacy,
            'profile_completeness_pct' => 40,
        ]);

        // Create default Kundli
        Kundli::create([
            'user_id' => $user->id,
            'birth_date' => $user->date_of_birth,
            'horoscope_opt_out' => false,
        ]);

        // Create default Partner Preference
        PartnerPreference::create([
            'user_id' => $user->id,
            'min_age' => $user->gender === 'male' ? max(18, $age - 6) : max(21, $age),
            'max_age' => $user->gender === 'male' ? $age : $age + 8,
            'caste_no_bar' => true,
            'gotra_exclusion' => true,
        ]);

        Auth::login($user);

        AuditLog::log('user_registered', ['role' => $user->role, 'managed_by' => $user->profile_managed_by], $user->id);

        return redirect()->route('profile.edit')->with('success', 'Account created successfully! Please complete your Biodata to increase compatibility discovery.');
    }

    public function logout(Request $request)
    {
        AuditLog::log('user_logged_out', [], Auth::id());
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Switch between demo accounts for instant evaluation
    public function demoLogin(Request $request)
    {
        $email = $request->query('email', 'arun@example.com');
        $user = User::where('email', $email)->first();
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', "Logged in as {$user->name} ({$user->role})");
        }
        return redirect()->route('login');
    }
}

