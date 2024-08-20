<?php
namespace Modules\Promotion;

use Modules\Promotion\Models\Coupon;
use Modules\Cart\Models\Cart;
use Illuminate\Support\Carbon;

class CouponService
{
    public function getAll()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->paginate(10);
        if (!$coupons) {
            return abort(404);
        }
        return $coupons;
    }
    public function getById($id)
    {
        $coupon = Coupon::find($id);
        if (!$coupon) {
            return [
                'success' => false,
                'message' => 'Coupon not found.',
            ];
        }
        return [
            'success' => true,
            'coupon' => $coupon,
        ];
    }
    public function delete($id)
    {
        $coupon = Coupon::find($id);
        if (!$coupon) {
            return abort(404);
        }
        $coupon->delete();
        return [
            'success' => true,
        ];
    }
    public function update($id, array $data)
    {
        $coupon = Coupon::find($id);
        if (!$coupon) {
            return [
                'success' => false,
                'message' => 'Không tìm thấy mã giảm giá.',
            ];
        }

        $coupon->update($data);
        return [
            'success' => true,
        ];
    }
    public function createCoupon(array $data)
    {
        return Coupon::create($data);
    }
    public function applyCoupon($couponCode, $cartItems)
    {
        // Fetch coupon
        $couponn=Coupon::where('code', $couponCode)->first();
        $coupon = Coupon::where('code', $couponCode)
            ->where('total', '>', $couponn->used)
            ->whereDate('start_date', '<=', now())
            ->whereDate('expired_date', '>', now())
            ->first();

        if (!$coupon) {
            return [
                'success' => false,
                'message' => 'Mã coupon không hợp lệ, đã sử dụng hết hoặc đã hết hạn.'
            ];
        }

        // Initialize the result variable
        $discountedTotal = 0;

        // Process cart items
        if (!$cartItems || !isset($cartItems['items'])) {
            return [
                'success' => false,
                abort(404),
            ];
        } else {
            // Calculate total price for all items in the shop
            $totalPrice = 0;
            foreach ($cartItems['items'] as $item) {
                $totalPrice += $item['total_price'];
            }

            // Check if the total price meets the coupon's minimum requirement
            if ($totalPrice <= $coupon->from) {
                // If the total price does not meet the minimum requirement, no discount is applied
                $discountedTotal = $totalPrice;
            } else {
                $discountAmount = 0;
                // Calculate discount based on percentage or maximum value
                if ($totalPrice * ($coupon->percent / 100) < $coupon->value) {
                    $discountAmount = $totalPrice * ($coupon->percent / 100);
                } else {
                    // Use fixed discount value
                    $discountAmount = $coupon->value;
                }

                // Ensure discount amount does not exceed the total price
                $discountAmount = min($discountAmount, $totalPrice);

                // Calculate the new total price after discount
                $discountedTotal = $totalPrice - $discountAmount;
            }
        }

        return [
            'success' => true,
            'discountedTotal' => $discountedTotal,
            'coupon' => $coupon,
        ];
    }
}
