<?php

namespace Modules\Order\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Modules\Order\DTO\Request\SearchOrderRequest;
use Modules\Order\Request\ChangeStatusRequest;
use Modules\Order\Service\ChangeStatusService;
use Modules\Order\Service\GetListOrderService;
use Modules\Order\Service\GetOrderByIdService;
use Modules\Shop\Helpers\ResponseTrait;

class OrderControllerApi
{

    use ResponseTrait;
    private GetListOrderService $getListOrderService;
    private ChangeStatusService $changeStatusService;
    private GetOrderByIdService $getOrderByIdService;
    public function __construct(
        GetListOrderService $getListOrderService,
        ChangeStatusService $changeStatusService,
        GetOrderByIdService $getOrderByIdService
    )
    {
        $this->getListOrderService = $getListOrderService;
        $this->getOrderByIdService = $getOrderByIdService;
        $this->changeStatusService = $changeStatusService;
    }

    public function getListOrder(Request $request) : JsonResponse
    {
        try {
            $searchParam = $this->extractSearchParam($request);
            $orders = $this->getListOrderService->handle($searchParam);
            return $this->successResponse($orders);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    public function getOrderById(Request $request, $id) : JsonResponse
    {
        try {
            $orders = $this->getOrderByIdService->handle($id);
            return $this->successResponse($orders);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function changeStatus(ChangeStatusRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->changeStatusService->handle($request->get('status'), $id);
            DB::commit();
            return $this->successResponse([]);
        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }


    public function extractSearchParam(Request $request): SearchOrderRequest
    {
        return new SearchOrderRequest(
            $request->get('status') ?? null,
            $request->get('page_size') ?? null,
        );
    }
}
