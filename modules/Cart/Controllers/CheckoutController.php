<?php

namespace Modules\Cart\Controllers;

use Modules\Cart\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\cart\CartService;
use Modules\Promotion\Models\Coupon;
use Auth;

class CheckoutController
{
    protected $checkoutService;
    protected $cartService;
    public function __construct(
        CheckoutService $checkoutService,
        CartService $cartService
    ) {
        $this->checkoutService = $checkoutService;
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $userId = Auth::id();
        $items = $request->session()->get('items');

        if (is_null($userId) || is_null($items)) {
            return abort(404, 'Dữ liệu không hợp lệ.');
        }

        if (!Auth::check()) {
            return abort(403, 'Vui lòng đăng nhập chính chủ.');
        }
        $checkout = $this->checkoutService->getCheckout($userId);
        if (!$checkout) {
            return abort(404, 'Hãy đăng nhập trước khi thanh toán.');
        }

        $groupedItems = $this->checkoutService->processItems($items);
        $totalPrice = array_sum(array_column($groupedItems, 'total_price'));

        return view('Cart::frontend.checkout', compact('checkout', 'groupedItems', 'totalPrice'));
    }


    public function processCheckout(Request $request)
    {
        if(!Auth::check()){
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập!'], 403);
        }
        $data = $request->json()->all();
        $userId = Auth::id();;
        $items = $data['items'] ?? [];
        if (is_null($userId) || empty($items)) {
            return response()->json(['success' => false, 'message' => 'Dữ liệu không hợp lệ!'], 400);
        }
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Vui lòng truy cập chính chủ!'], 403);
        }

        try {
            // Lưu trữ dữ liệu vào session
            session(['user_id' => $userId, 'items' => $items]);

            return response()->json(['success' => true, 'checkout_url' => route('checkout.index')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function getCouponIdByCode(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('code', $couponCode)->first();
        return response()->json(['coupon_id' => $coupon->id], 200);
    }


    public function getProvinces()
    {
        $response = Http::get('https://api.ghsv.vn/v1/address/provinces');
        return response()->json($response->json());
    }

    public function getDistricts(Request $request)
    {
        $response = Http::post('https://api.ghsv.vn/v1/address/districts', [
            'province_code' => $request->input('province_code'),
        ]);
        return response()->json($response->json());
    }

    public function getWards(Request $request)
    {
        $response = Http::post('https://api.ghsv.vn/v1/address/wards', [
            'district_code' => $request->input('district_code'),
        ]);
        return response()->json($response->json());
    }
}

