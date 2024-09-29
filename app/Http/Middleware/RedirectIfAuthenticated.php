<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return match (Auth()->user()->role) {
                    'manager' => redirect()->route('admin.dashboard'),
                    'staff' => redirect()->route('admin.dashboard'),
                    'cashier' => redirect()->route('cashier.dashboard'),
                };
            }
        }

        return $next($request);
    }
}
