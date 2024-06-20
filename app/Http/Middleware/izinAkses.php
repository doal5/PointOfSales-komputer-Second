<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class izinAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $level, $level2): Response
    {
        // cek login dan admin
        if (auth()->user() && $level && $level2 == auth()->user()->level) {
            return $next($request);
        };

        // jika tidak ada
        return redirect()->route('login');
    }
}
