<?php
namespace Modules\Product\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Product\Models\Review;

class GetProductReviewService
{
    public function handle(int $productId, ?string $filter): LengthAwarePaginator
    {
        $query = Review::where("product_id", $productId)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->with('variant');
        if (!empty($filter)) {
            $query = $query->where('rating', $filter);
        }
        return $query->paginate(5);
    }
}