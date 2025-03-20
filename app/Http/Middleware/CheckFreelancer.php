<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFreelancer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!$request->user()) {
            session()->flash('error', 'You must be logged in to access this page.');
            return redirect()->route('account.login');
        }

        // Check if the user is a freelancer
        if ($request->user()->role != 'freelancer') {
            session()->flash('error', 'You are not a Freelancer! Only Freelancers are authorized on this page!');
            return redirect()->route('account.profile');
        }

        return $next($request);
    }
}
