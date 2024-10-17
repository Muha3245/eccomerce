<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Check if the user's role_id is in the allowed roles
        if (!in_array(Auth::user()->role_id, $roles)) {
            return redirect('/'); // Redirect if not authorized
        }

        return $next($request);
    }
}
