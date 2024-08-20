<?php
namespace Modules\Order\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Modules\Order\Domain\Order;
use Modules\Order\Domain\OrderDetail;
use Modules\Order\DTO\Request\OrderRequest;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Order\Models\Coupon;
use Modules\Order\Repositories\Contracts\CartRepositoryInterface;
use Modules\Order\Repositories\Contracts\OrderRepositoryInterface;
use Modules\Order\Repositories\Eloquent\CartRepository;
use Modules\Order\Repositories\Eloquent\OrderRepository;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\Models\Shop;
use Modules\Shop\Models\User;

/**
 *
 */
class CheckoutService {
    /**
     *
     */

    private CartRepositoryInterface $cartRepository;
    private OrderRepositoryInterface $orderRepository;
    public function __construct(
        CartRepository $cartRepository,
        OrderRepository $orderRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param OrderRequest $request
     * @return void
     */
    public function handle(OrderRequest $request): void
    {
        $listCoupon = [];
        $productDetail = [];
        $listProductBuy = [];
        foreach ($request->getCoupons() as $coupon) {
            $listCoupon[$coupon->getShopId()] = $coupon->getCouponId();
        }

        foreach ($request->getDetail() as $product){
            $productDetail[$product->getProductVariantId()] = $product->getQuantity();
            $listProductBuy[] = $product->getProductVariantId();
        }

        if(!Auth::check()){
            throw new Exception("You must login");
        }

        $userLogin = Auth::user() ?? User::where("id", 2)->first();

        $productInDB = ProductVariant::query()
            ->whereIn('product_variants.id', $listProductBuy)
            ->with('product')
            ->get();


        $listCartByShop = $productInDB
            ->groupBy(function ($variant) {
                return $variant->product->shop_id;
            })
            ->map(function ($byShop, $index) use ($userLogin,$listCoupon, $request, $productDetail) {
                $order = new Order();
                $orderDetails = [];
                $sumPrice = 0;
                $discount = 0;
                $coupon = null;

                $order->setId(null);
                $order->setCustomerId($userLogin->id);
                $order->setShopId($index);
                $order->setStatus(StatusOrderEnum::STATUS_PENDING);
                $order->setEmail($request->getEmail());
                $order->setAddress($request->getAddress());
                $order->setPhoneNumber($request->getPhoneNumber());
                $order->setDescription($request->getDescription());

                foreach ($byShop as $detail){
                    $tmp = new OrderDetail();
                    $tmp->setQuantity($productDetail[$detail->id]);
                    $tmp->setSalePrice($detail->sale_price);
                    $tmp->setImportPrice($detail->import_price);
                    $tmp->setVariantId($detail->id);
                    $tmp->setId(null);
                    $tmp->setOrder(null);
                    $orderDetails[] = $tmp;
                    $sumPrice += $tmp->getSalePrice() * $tmp->getQuantity();
                }

                if (array_key_exists($index, $listCoupon)) {
                    $coupon = Coupon::query()
                        ->where('id', $listCoupon[$index])
                        ->whereDate('start_date','<=', Carbon::now())
                        ->whereDate('expired_date','>=', Carbon::now())
                        ->first();
                }
                if(!is_null($coupon) && $coupon->from <= $sumPrice && $coupon->used < $coupon->total ){
                    $discountTmp = ($coupon->percent * $sumPrice) / 100;
                    $discount = min($discountTmp,$coupon->value);
                    $coupon->used += 1;
                    $coupon->save();
                }

                $order->setDiscount($discount);
                $order->setFinalCost(max($sumPrice - $discount, 0));
                $order->setOrderDetails($orderDetails);

                return $order;
            })
        ;
        foreach ($listCartByShop as $order){
            $this->orderRepository->checkout($order);
        }

        $this->cartRepository->clearCartByUserId($userLogin->id, $request->getCarts());
    }
}
