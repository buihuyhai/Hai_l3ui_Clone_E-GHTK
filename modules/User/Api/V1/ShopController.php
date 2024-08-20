<?php

namespace Modules\User\Api\V1;

use Illuminate\Http\Request;
use Modules\Core\Api\BaseController;
use Modules\User\Services\Shop\GetShopService;

class ShopController extends BaseController
{
    protected GetShopService $getShopService;

    public function __construct(GetShopService $getShopService)
    {
        $this->getShopService = $getShopService;
    }

    public function index()
    {
    }

    public function getLimit(Request $request)
    {
        $response = $this->getShopService
            ->getShopsLimit($request->limit ?? config("response.pagination.limit"));

        if (!$response['status'])
            return $this->responseBadRequest();

        return $this->responseSuccess(
            $response['data'],
            'Success'
        );
    }


}
