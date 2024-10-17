<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/'); // Redirect if not logged in
        }
    
        $user = Auth::user(); // Get the authenticated user
        $userRole = $user->role; // Get user's role
    
        // Check if the user's role matches any of the required roles
        foreach ($roles as $role) {
            if ($userRole === $role) {
                return $next($request); // Allow access if role matches
            }
        }
    
        // Redirect if user doesn't have the required role
        return redirect('/'); 
    }
}
