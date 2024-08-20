<?php

namespace Modules\Shop\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Modules\Shop\Helpers\ResponseTrait;
use Modules\Shop\Service\Product\GetListProductToAnalysisService;

class DashboardShopController
{
    use ResponseTrait;

    public function __construct(
    )
    {
    }

    public function dashboard(Request $request): Factory|Application|View|\Illuminate\View\View
    {
        return view('Shop::admin.dashboard');
    }

}
