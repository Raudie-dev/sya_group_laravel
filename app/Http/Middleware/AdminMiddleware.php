<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user instanceof \App\Models\User && $user->isAdmin()) {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado.');
    }
}
