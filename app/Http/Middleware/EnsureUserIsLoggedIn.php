<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsLoggedIn
{
    /**
     * Handle an incoming request.  
     */
    public function handle(Request $request, Closure $next, $redirectType = 'login')
    {
        if (!auth()->check()) {
            if ($redirectType === '404') {
                abort(404); // trả về 404
            }
            // mặc định redirect về login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
