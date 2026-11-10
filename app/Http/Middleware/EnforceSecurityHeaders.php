<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceSecurityHeaders
{
    /**
     * Handle an incoming request.
     * Enforces enterprise security headers according to OWASP Top 10 guidelines.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        // 1. Prevent Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // 2. Prevent MIME-type Confusion / Sniffing attacks
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 3. Referrer Privacy Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 4. Permissions Policy (Disables microphone, restricts camera to self for biometric KYC)
        $response->headers->set('Permissions-Policy', 'camera=(self), microphone=(), geolocation=()');

        // 5. HTTP Strict Transport Security (HSTS) when on HTTPS
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // 6. Content Security Policy (CSP)
        // Accommodates Tailwind CDN, Alpine.js, Google Fonts, Reverb WebSockets, and Cloudflare Turnstile
        $cspDirectives = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://cdn.jsdelivr.net https://challenges.cloudflare.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "font-src 'self' data: https://fonts.gstatic.com",
            "img-src 'self' data: blob:",
            "connect-src 'self' ws: wss: http://127.0.0.1:* http://localhost:* https://challenges.cloudflare.com",
            "frame-src 'self' https://challenges.cloudflare.com",
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self'",
        ];

        $response->headers->set('Content-Security-Policy', implode('; ', $cspDirectives));

        return $response;
    }
}

