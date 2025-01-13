<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user || $user->peran->nama_peran !== $role) {
            return redirect('/')->with('error', 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
