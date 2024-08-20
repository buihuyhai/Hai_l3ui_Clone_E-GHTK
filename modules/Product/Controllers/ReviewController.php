<?php
namespace Modules\Product\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Modules\Product\Models\OrderDetail;
use Modules\Product\Models\ProductVariant;
use Modules\Product\Services\CreateReviewService;
use Modules\Product\Services\GetProductBySlugService;
use Modules\Product\Services\GetProductReviewService;
use Symfony\Component\HttpFoundation\Response;

class ReviewController
{
    use AuthorizesRequests;
    private $reviewService;
    private $productService;
    private $getProductReviewService;
    public function __construct(
        CreateReviewService $reviewService,
        GetProductReviewService $getProductReviewService,
        GetProductBySlugService $getproductService
    ) {
        $this->reviewService = $reviewService;
        $this->productService = $getproductService;
        $this->getProductReviewService = $getProductReviewService;
    }
    public function create(Request $request, $slug)
    {
        $product = $this->productService->handle($slug);
        $productVariant = ProductVariant::find($request->variant_id);
        $user = auth()->user();
        $this->authorize('create', $productVariant);
        $reviewData = array_merge($request->all(), [
            'user_created' => $user->id,
            'product_id' => $product->id,
        ]);
        $review = $this->reviewService->handle($reviewData);
        if ($review) {
            return response()->json([
                'success' => true,
                'data' => $review,
                'message' => 'Đánh giá sản phẩm thành công!',
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Review creation failed',
            'error' => 'Review creation failed',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function filter(Request $request, $slug)
    {
        $product = $this->productService->handle($slug);
        $reviews = $this->getProductReviewService->handle($product->id, $request->filter);
        return view("Product::frontend.components.review.list", compact("reviews"));
    }
}