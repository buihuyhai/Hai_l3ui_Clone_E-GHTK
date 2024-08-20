<?php
namespace Modules\Product\Services\Contracts;

interface CreateReviewServiceInterface
{
    public function create(array $data);
    public function getProductReviews(int $productId);
    public function getProductReviewsByRating(int $rating, int $productId);
}