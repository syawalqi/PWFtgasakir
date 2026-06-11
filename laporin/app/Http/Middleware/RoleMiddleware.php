<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // 1. Validasi apakah user sudah melakukan login sistem
        if (!$request->user()) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Memeriksa apakah role user terdaftar di dalam array parameter middleware
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki otoritas menuju halaman ini.');
        }

        return $next($request);
    }
}