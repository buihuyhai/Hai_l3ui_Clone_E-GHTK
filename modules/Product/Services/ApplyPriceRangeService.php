<?php

namespace Modules\Product\Services;

use Illuminate\Database\Eloquent\Builder;

class ApplyPriceRangeService
{

    public function handle(Builder $query, ?int $minPrice = null, ?int $maxPrice = null): Builder
    {
        if ($minPrice === null && $maxPrice === null) {
            return $query;
        }

        if ($minPrice !== null && $maxPrice !== null && $minPrice > $maxPrice) {
            return $query;
        }

        if ($minPrice !== null && $maxPrice !== null) {
            return $query->whereBetween('sale_price', [$minPrice, $maxPrice]);
        }

        if ($minPrice !== null) {
            return $query->where('sale_price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            return $query->where('sale_price', '<=', $maxPrice);
        }  

        return $query;
    }
}
