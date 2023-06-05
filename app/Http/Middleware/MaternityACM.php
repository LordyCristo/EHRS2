<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MaternityACM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if the user is authenticated and the role is maternity or a doctor
        if (Auth::check()) {
            // if the user is authenticated and the role is maternity proceed to the next request
            if (Auth::user()->role === 8 || Auth::user()->role === 1)
                return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
