<?php

namespace Modules\Shop\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Shop\Models\User;
use Symfony\Component\HttpFoundation\Response;

class ShopMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $userLogin = Auth::user();
        if($userLogin === null){
            return redirect()->route('login');
        }

        $user = User::query()->where('id', $userLogin->id)
            ->with('shop')
            ->first();
        $shop = $user->shop()->first();
        if($shop === null){
            return redirect()->route('login');
        }
        Session::put('shop', $shop);

        return $next($request);
    }
}
