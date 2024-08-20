<?php

namespace Modules\Product\Services;

use Modules\Product\Models\Category;
use Modules\Product\Models\Product;


class CategoryService
{
    public function getAll()
    {
        return Category::all();
    }
    public function getBySlug($request)
    {
        $category = Category::where('slug', $request->slug)
            ->first();
        if (!$category) {
            return null;
        }
        $query = Product::where('category_id', $category->id);
        $this->applyPriceFilter($query, $request->minPrice, $request->maxPrice);
        $category['products'] = $query
            ->orderByRaw($this->getOrderBy($request->orderby))
            ->paginate(30);
        return $category;
    }
    private function applyPriceFilter($query, ?string $minPrice, ?string $maxPrice): void
    {
        if (!is_null($minPrice) && is_null($maxPrice)) {
            $query->where('sale_price', '>=', $minPrice);
        } elseif (is_null($minPrice) && !is_null($maxPrice)) {
            $query->where('sale_price', '<=', $maxPrice);
        } elseif (!is_null($minPrice) && !is_null($maxPrice)) {
            $query->whereBetween('sale_price', [$minPrice, $maxPrice]);
        }
    }

    private function getOrderBy(?string $orderby): string
    {
        $sortOptions = [
            'price-asc' => 'sale_price ASC',
            'price-desc' => 'sale_price DESC',
            'rating' => 'rating DESC',
            'selling' => 'sold DESC',
            'latest' => 'created_at DESC',
        ];

        return $sortOptions[$orderby] ?? 'created_at DESC';
    }
}