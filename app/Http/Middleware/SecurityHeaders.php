<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Try to remove server disclosure header if present
        @header_remove('X-Powered-By');
        $response->headers->remove('X-Powered-By');

        // Clickjacking protection
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Prevent MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Permissions policy (restrict features)
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // Content Security Policy - conservative default
        $csp = "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; font-src 'self' https://fonts.bunny.net; img-src 'self' data:; connect-src 'self';";
        $response->headers->set('Content-Security-Policy', $csp);

        // Referrer policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Remove Server header from response if present
        $response->headers->remove('Server');

        // Ensure XSRF cookie is present for clients (helps scanners detect CSRF tokens)
        try {
            if (function_exists('cookie')) {
                $cookie = cookie('XSRF-TOKEN', csrf_token(), config('session.lifetime'));
                $response->headers->setCookie($cookie);
            }
        } catch (\Throwable $e) {
            // ignore if something goes wrong here
        }

        return $response;
    }
}
