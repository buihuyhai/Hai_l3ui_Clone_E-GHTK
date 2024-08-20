<?php

namespace Modules\Order\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Modules\Order\DTO\Request\CouponRequest;
use Modules\Order\DTO\Request\DetailOrderRequest;
use Modules\Order\DTO\Request\OrderRequest;
use Modules\Order\Request\CheckoutRequest;
use Modules\Order\Service\CheckoutService;
use Modules\Shop\Helpers\ResponseTrait;

class CheckoutController
{
    use ResponseTrait;

    /**
     * @var CheckoutService
     */
    private CheckoutService $checkoutService;

    /**
     * @param CheckoutService $checkoutService
     */
    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * @param CheckoutRequest $request
     * @return JsonResponse
     */
    public function checkout(CheckoutRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $coupons = json_decode($request->get('coupons'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON format coupons");
            }

            $detailOrder = json_decode($request->get('detail'), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON format variants");
            }

            $couponDto = [];
            foreach ($coupons as $coupon){
                $couponDto[] = new CouponRequest($coupon['shop_id'], $coupon['coupon_id']);
            }

            $orderDetailDTO = [];
            foreach ($detailOrder as $detail){
                $orderDetailDTO[] = new DetailOrderRequest($detail['product_variant_id'], $detail['quantity']);
            }

            $dto = new OrderRequest(
                $request->get('email'),
                $request->get('address'),
                $request->get('phone_number'),
                $request->get('description', []),
                $couponDto,
                $orderDetailDTO,
                $request->get('carts')  ?? []
            );

            $this->checkoutService->handle($dto);

            DB::commit();
            return $this->successResponse([]);
        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

}
