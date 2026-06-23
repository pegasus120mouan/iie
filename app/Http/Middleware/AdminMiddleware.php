<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->isAdmin() || ! auth()->user()->is_active) {
            if (auth()->check()) {
                auth()->logout();
            }

            return redirect()->route('admin.login')->with('error', 'Accès non autorisé.');
        }

        return $next($request);
    }
}
