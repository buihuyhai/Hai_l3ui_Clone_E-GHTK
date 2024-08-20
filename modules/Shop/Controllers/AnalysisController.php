<?php

namespace Modules\Shop\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Modules\Shop\Helpers\ResponseTrait;
use Modules\Shop\Service\Product\GetListProductToAnalysisService;

class AnalysisController
{
    use ResponseTrait;
    private GetListProductToAnalysisService $getListProductToAnalysisService;

    public function __construct(
        GetListProductToAnalysisService $getListProductToAnalysisService

    )
    {
        $this->getListProductToAnalysisService = $getListProductToAnalysisService;

    }

    public function analysis(Request $request): Factory|Application|View|\Illuminate\View\View
    {
        $products = $this->getListProductToAnalysisService->handle();

        return view('Shop::admin.analysis',[
            'products' => $products,
        ]);
    }
}
