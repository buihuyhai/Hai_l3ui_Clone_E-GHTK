<?php
namespace Modules\Product\Services;

use Illuminate\Support\Facades\DB;
use Modules\Product\Models\OrderDetail;
use Modules\Product\Models\Product;
use Modules\Product\Models\Review;

class CreateReviewService
{
    public function handle(array $data)
    {
        $review = null;
        DB::transaction(function () use ($data, &$review) {
            $review = Review::create($data);
            if ($review) {
                $product = Product::findOrFail($review->product_id);
                $product->total_star += $review->rating;
                $product->total_review += 1;
                $product->rating = $product->total_star / $product->total_review;
                $product->save();
                $orderDetail = OrderDetail::find($data['order_detail_id']);
                $orderDetail->rstatus = 1;
                $orderDetail->save();
            }
        });
        return $review;
    }
}