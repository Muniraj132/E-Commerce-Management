<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        // Check if the user is an admin
        if (Auth::user() && Auth::user()->role !== 'admin') {
            // If not an admin, redirect them to the homepage or any other page
            return redirect('/'); 
        }

          return $next($request);
    }
}
