<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class RedirectIfNotVisitor
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->status === 1 && auth()->user()->verified)
        {
            return $next($request);
        }
        return redirect(RouteServiceProvider::BASE);
    }
}
