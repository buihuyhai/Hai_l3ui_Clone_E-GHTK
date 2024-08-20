<?php

namespace Modules\Shop\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Shop\Helpers\ResponseTrait;
use Modules\Shop\Service\Analysis\ReportBasicForMonthService;
use Modules\Shop\Service\Analysis\ReportBasicService;
use Modules\Shop\Service\Analysis\ReportBasicTopSellingInYearService;

class DashboardShopControllerApi
{
    use ResponseTrait;
    private ReportBasicService $reportBasicService;
    private ReportBasicForMonthService $reportBasicForMonthService;
    private ReportBasicTopSellingInYearService $reportBasicTopSellingInYearService;
    public function __construct(
        ReportBasicService $reportBasicService,
        ReportBasicForMonthService $reportBasicForMonthService,
        ReportBasicTopSellingInYearService $reportBasicTopSellingInYearService
    )
    {
        $this->reportBasicService = $reportBasicService;
        $this->reportBasicForMonthService = $reportBasicForMonthService;
        $this->reportBasicTopSellingInYearService = $reportBasicTopSellingInYearService;
    }

    public function reportBasic(Request $request): JsonResponse
    {
        try {
            $result = $this->reportBasicService->handle();
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function reportBasicForMonth(Request $request) : JsonResponse
    {
        try {
            $year = $request->get('year') ?? null;
            $result = $this->reportBasicForMonthService->handle($year);
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    public function reportBasicTopSellingInYear(Request $request): JsonResponse
    {
        try {
            $year = $request->get('year') ?? null;
            $result = $this->reportBasicTopSellingInYearService->handle($year);
            return $this->successResponse($result);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

}
