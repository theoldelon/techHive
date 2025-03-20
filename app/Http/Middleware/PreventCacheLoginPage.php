<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PreventCacheLoginPage
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the response from the next middleware or controller
        $response = $next($request);

        // Ensure that the response is an instance of Illuminate\Http\Response
        if (!$response instanceof Response) {
            $response = new Response($response);
        }

        // Apply no-cache headers on login/logout
        if (Auth::guest() || $request->is('account/login') || $request->is('account/logout')) {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                     ->header('Pragma', 'no-cache')
                     ->header('Expires', '0');
        }

        return $response;
    }
}
