<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isAdmin())
            return $next($request);

        throw new AuthenticationException('Authenticated user is not admin.');
    }
}
