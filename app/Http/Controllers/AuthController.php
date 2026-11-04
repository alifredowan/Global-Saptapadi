<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status === 'banned' || $user->status === 'suspended') {
                Auth::logout();
                return back()->withErrors(['email' => 'This account has been restricted due to community ethics policy violations.']);
            }

            AuditLog::log('user_logged_in', ['email' => $user->email], $user->id);

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }
            if ($user->role === 'family_rep') {
                return redirect()->intended(route('family.dashboard'));
            }

            return redirect()->intended(route('discovery.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'role' => 'required|in:groom,bride,family_rep',
            'profile_managed_by' => 'required|in:self,father,mother,brother,sister,uncle,aunt,grandparent,other',
            'marital_status' => 'required|in:never_married,divorced,widowed,annulled',
            'password' => 'required|string|min:8|confirmed',
            'anti_bot_verified' => 'required|accepted',
        ]);

        // Statutory Legal Marriage Age Enforcement (URS FR-1.2 & Legal Framework)
        // Minimum 21 for males, 18 for females
        $dob = Carbon::parse($validated['date_of_birth']);
        $age = $dob->age;

        if ($validated['gender'] === 'male' && $age < 21) {
            return back()->withErrors([
                'date_of_birth' => "Underage registration barred: Statutory minimum marriage age for males is 21 years under the Hindu Marriage Act. Candidate is currently {$age} years old."
            ])->withInput();
        }

        if ($validated['gender'] === 'female' && $age < 18) {
            return back()->withErrors([
                'date_of_birth' => "Underage registration barred: Statutory minimum marriage age for females is 18 years. Candidate is currently {$age} years old."
            ])->withInput();
        }

        // Strict Monogamy Check (URS FR-1.1 & Monogamy Mandate)
        if ($validated['marital_status'] === 'married') {
            return back()->withErrors([
                'marital_status' => 'Polygamy and bigamy are strictly barred under Hindu personal law. Only unmarried, divorced, or widowed seekers may register.'
            ])->withInput();
        }

        // Set role based on gender if seeker
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
            if ($user->role === 'admin') return redirect()->route('admin.dashboard');
            if ($user->role === 'family_rep') return redirect()->route('family.dashboard');
            return redirect()->route('discovery.index')->with('success', "Logged in as {$user->name} ({$user->role})");
        }
        return redirect()->route('login');
    }
}

