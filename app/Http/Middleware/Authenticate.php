<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // kalo tidak ada yang login, akan dikembalikan kehalaman login
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
