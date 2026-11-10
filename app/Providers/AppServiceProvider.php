<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // System-wide default date and time formatting: DD/MM/YYYY
        Carbon::macro('toSystemFormat', function () {
            return $this->format('d/m/Y');
        });
        Carbon::macro('toSystemDateTimeFormat', function () {
            return $this->format('d/m/Y H:i:s');
        });

        // 1. Rate Limiting for Authentication (Brute-force / Credential Stuffing defense)
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->input('email', '');
            return Limit::perMinute(5)->by($email . '|' . $request->ip())->response(function () {
                return back()->with('error', 'Too many login attempts. Please wait 1 minute before trying again.');
            });
        });

        // 2. Rate Limiting for Account Registration (Anti-Bot / Sybil attack defense)
        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinutes(10, 5)->by($request->ip())->response(function () {
                return back()->with('error', 'Too many registration requests. Please wait a few minutes.');
            });
        });

        // 3. Rate Limiting for Chaperoned Messaging (Spam / Harassment defense)
        RateLimiter::for('messages', function (Request $request) {
            $identifier = $request->user()?->id ?: $request->ip();
            return Limit::perMinute(30)->by((string) $identifier);
        });

        // 4. Rate Limiting for Proposal Transmissions
        RateLimiter::for('proposals', function (Request $request) {
            $identifier = $request->user()?->id ?: $request->ip();
            return Limit::perMinute(10)->by((string) $identifier);
        });
    }
}
