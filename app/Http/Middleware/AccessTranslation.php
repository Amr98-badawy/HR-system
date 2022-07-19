<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessTranslation
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->can('access_translation')) {
            return $next($request);
        }
        return redirect()->route('dashboard.home');
    }
}
