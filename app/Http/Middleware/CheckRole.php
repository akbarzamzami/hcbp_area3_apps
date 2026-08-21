<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            return match ($user->role) {
                'admin_master' => redirect()->route('admin-master.dashboard'),
                'admin_area' => redirect()->route('admin-area.dashboard'),
                'atasan' => redirect()->route('atasan.idp.daftar'),
                'bawahan' => redirect()->route('bawahan.dashboard'),
                default => redirect()->route('login'),
            };
        }

        return $next($request);
    }
}
