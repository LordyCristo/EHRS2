<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DentalACM
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if the user is authenticated and the role is dental or a doctor
        if (Auth::check()) {
            // if the user is authenticated and the role is dental proceed to the next request
            if (Auth::user()->role === 5 || Auth::user()->role === 1)
                return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
