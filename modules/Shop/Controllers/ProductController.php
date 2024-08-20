<?php

namespace Modules\Shop\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Shop\Models\User;
use Modules\Shop\Service\Product\GetListCategoryService;

class ProductController
{
    /**
     * @var GetListCategoryService
     */
    private GetListCategoryService $getListCategoryService;

    /**
     * @param GetListCategoryService $getListCategoryService
     */
    public function __construct(GetListCategoryService $getListCategoryService)
    {
        $this->getListCategoryService = $getListCategoryService;
    }

    /**
     * @param Request $request
     * @return Factory|View|Application|\Illuminate\View\View
     * @throws \Exception
     */
    public function create(Request $request): Factory|View|Application|\Illuminate\View\View
    {
        $categories = $this->getListCategoryService->handle();
        return view('Shop::admin.create_product',[
            'categories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Factory|View|Application|\Illuminate\View\View
     * @throws \Exception
     */
    public function update(Request $request, $id): Factory|View|Application|\Illuminate\View\View
    {
        $categories = $this->getListCategoryService->handle();
        return view('Shop::admin.update_product',[
            'categories' => $categories,
            'productId' => $id,
        ]);
    }
}
