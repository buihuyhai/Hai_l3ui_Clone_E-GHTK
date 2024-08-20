<?php
namespace Modules\Order\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\DTO\Request\SearchOrderRequest;
use Modules\Order\DTO\Response\OrderResponse;
use Modules\Order\DTO\Response\ResponseListOrder;
use Modules\Order\Models\Order;
use Modules\Shop\DTO\Response\PaginateResponse;

/**
 *
 */
class GetListOrderService {
    /**
     *
     */

    public function __construct(
    ) {
    }

    /**
     * @param SearchOrderRequest $request
     * @return array
     */
    public function handle(SearchOrderRequest $request): array
    {
        $orderResponse = null;
        $shop = Session::get('shop');
        $pageList = [];
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }

        $orders = Order::beLongsToShop($shop->id)
            ->with('customer')
            ->withFilter($request)
            ->paginate($request->getPageSize());

        $orderArray = $orders->toArray();

        foreach ($orderArray['links'] as $page){
            $pageList[] = (new PaginateResponse(
                $page['label'],
                $page['active'],
                (int) (explode("?page=", $page['url'] ?? "")[1] ?? null)
            ))->toArray();
        }

        foreach ($orders as $order){
            $tmp = new OrderResponse(
            );
            $tmp->setId($order->id);
            $tmp->setCustomerName($order->customer_name);
            $tmp->setDiscount($order->discount);
            $tmp->setFinalCost($order->final_cost);
            $tmp->setEmail($order->email);
            $tmp->setAddress($order->address);
            $tmp->setPhoneNumber($order->phone_number);
            $tmp->setStatus($order->status_name);
            $tmp->setStatusCode($order->status);
            $orderResponse[] = $tmp->toArray();
        }

        return  (new ResponseListOrder(
            $orderResponse,
            $orderArray['total'],
            $orderArray['current_page'],
            $orderArray['last_page'],
            $orderArray['per_page'],
            $pageList,
        ))->toArray();

    }
}
