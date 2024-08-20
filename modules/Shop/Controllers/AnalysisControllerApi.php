<?php

namespace Modules\Shop\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Shop\Helpers\ResponseTrait;
use Modules\Shop\Service\Analysis\AllMonthInYearService;
use Modules\Shop\Service\Analysis\AnalysisProductByIdService;
use Modules\Shop\Service\Analysis\OrderFollowService;
use Modules\Shop\Service\Analysis\ReportBasicForMonthService;
use Modules\Shop\Service\Analysis\ReportBasicService;
use Modules\Shop\Service\Analysis\ReportBasicTopSellingInYearService;
use Modules\Shop\Service\Analysis\RevenueAllShopService;
use Modules\Shop\Service\Analysis\RevenueInYearLyService;
use Modules\Shop\Service\Analysis\SaleAndInventoryLatestSevenDateService;

class AnalysisControllerApi
{
    use ResponseTrait;

    private OrderFollowService $orderFollowService;
    private RevenueAllShopService $revenueAllShopService;
    private AnalysisProductByIdService $analysisProductByIdService;
    private AllMonthInYearService $allMonthInYearService;
    private RevenueInYearLyService $revenueInYearLyService;
    private SaleAndInventoryLatestSevenDateService $saleAndInventoryLatestSevenDateService;
    public function __construct(
        OrderFollowService $orderFollowService,
        RevenueAllShopService $revenueAllShopService,
        AnalysisProductByIdService $analysisProductByIdService,
        AllMonthInYearService $allMonthInYearService,
        RevenueInYearLyService $revenueInYearLyService,
        SaleAndInventoryLatestSevenDateService $saleAndInventoryLatestSevenDateService
    )
    {
        $this->orderFollowService = $orderFollowService;
        $this->revenueAllShopService = $revenueAllShopService;
        $this->analysisProductByIdService = $analysisProductByIdService;
        $this->allMonthInYearService = $allMonthInYearService;
        $this->revenueInYearLyService = $revenueInYearLyService;
        $this->saleAndInventoryLatestSevenDateService = $saleAndInventoryLatestSevenDateService;
    }

    public function orderFollowStatus(Request $request): JsonResponse
    {
        try {
            $year = $request->get('year') ?? null;
            $result = $this->orderFollowService->handle($year);
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function analysisProductById(Request $request, $id) : JsonResponse
    {
        try {
            if($id === null){
                throw  new  Exception("Product variant not found");
            }
            $result = $this->analysisProductByIdService->handle($id);
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }


    public function revenueAllShop(Request $request) : JsonResponse
    {
        try {
            $result = $this->revenueAllShopService->handle();
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function revenueAllMonthInYear(Request $request) : JsonResponse
    {
        try {
            $year = $request->get('year') ?? null;
            $result = $this->allMonthInYearService->handle($year);
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function revenueYearLy(Request $request) : JsonResponse
    {
        try {
            $yearStart = $request->get('year_start');
            $yearEnd = $request->get('year_end');
            $result = $this->revenueInYearLyService->handle($yearStart, $yearEnd);
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function saleAndInventoryInSevenDate(Request $request) : JsonResponse
    {
        try {

            $result = $this->saleAndInventoryLatestSevenDateService->handle();
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

}
