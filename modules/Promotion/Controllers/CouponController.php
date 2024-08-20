<?php

namespace Modules\Promotion\Controllers;

use Illuminate\Http\Request;
use Modules\Promotion\CouponService;
use Auth;
use Modules\Promotion\Requests\UpdateCouponRequest;
use Modules\Promotion\Requests\AddCouponRequest;
use Modules\Promotion\Requests\ApplyCouponRequest;
use Modules\Promotion\Models\Coupon;
use DB;

class CouponController
{
    protected $couponService;
    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
    public function getALl()
    {
        if(!Auth::check()){
            return abort(403,"Bạn cần đăng nhập với quyền quản trị viên");
        }
        $coupons = $this->couponService->getAll();
        if (!$coupons) {
            return abort(404);
        }
        return view("Promotion::admin.index", compact("coupons"));
        // return response()->json($coupons);

    }
    public function delete($id)
    {
        if(!Auth::check()){
            return abort(403,"Bạn cần đăng nhập với quyền quản trị viên");
        }
        $coupon = $this->couponService->delete($id);
        if (!$coupon['success']) {
            return abort(404);
        }
        return redirect()->route('coupon.admin.index')->with('success', 'Xóa mã giảm giá thành công.');
    }
    public function update($id, UpdateCouponRequest $request)
    {
        $data = $request->validated();
        $result = $this->couponService->update($id, $data);

        if (!$result['success']) {
            return redirect()->back()->withErrors($result['message']);
        }

        return redirect()->route('coupon.admin.index')->with('success', 'Cập nhật mã giảm giá thành công.');
    }
    public function edit($id)
    {
        $result = $this->couponService->getById($id);
        if (!$result['success']) {
            return abort(404);
        }
        $coupon = $result['coupon'];
        return view('Promotion::admin.update', compact('coupon'));
    }
    public function getAdd()
    {
        return view('Promotion::admin.add');
    }
    public function addCoupon(AddCouponRequest $request)
    {
        try {
            $this->couponService->createCoupon($request->validated());
            return redirect()->route('coupon.admin.addui')->with('success', 'Thêm mới mã giảm giá thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        $cartItems = $request->input('cart_items');

        $result = $this->couponService->applyCoupon($couponCode, $cartItems);

        return response()->json($result);
    }



}
