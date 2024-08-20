<?php
namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Modules\Product\Models\Order;
use Modules\Product\Services\Contracts\UserOrderInterface;
use Modules\Product\Services\UserCancelOrderService;
use Modules\Product\Services\UserCreateOrderService;


class UserOrderController extends Controller
{
    use AuthorizesRequests;
    private $userOrderService;
    private $userCreateOrderService;
    private $userCancelOrderService;
    public function __construct(
        UserOrderInterface $userOrderService,
        UserCancelOrderService $userCancelOrderService
    ) {
        $this->userOrderService = $userOrderService;
        $this->userCancelOrderService = $userCancelOrderService;
    }
    public function index(Request $request)
    {
        $orders = $this->userOrderService
            ->getUserOrder(auth()->user()->id, $request->type);
        if ($request->ajax()) {
            return view("Product::frontend.components.order.list", compact("orders"));
        }
        return view("Product::frontend.order", compact("orders"));
    }
    public function cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $this->authorize("cancel", $order);
        return $this->userCancelOrderService->handle($request->order_id);
    }
}