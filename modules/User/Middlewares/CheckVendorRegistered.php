<?php

namespace Modules\User\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckVendorRegistered
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->shop()->first())
            return redirect()->route("shops.dashboard");
        return $next($request);
    }
}
