<?php

namespace Modules\Shop\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Shop\Models\User;

class ShopController
{
    /**
     *
     */
    public function __construct()
    {

    }


    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function updateShop(Request $request) : Factory|View|Application
    {
        return view('Shop::frontend.update_info_shop');
    }


    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function adminProduct(Request $request): Factory|View|Application
    {
        return view('Shop::admin.product');
    }
    public function orders(Request $request): Factory|View|Application
    {
        return view('Shop::admin.order');
    }
}
