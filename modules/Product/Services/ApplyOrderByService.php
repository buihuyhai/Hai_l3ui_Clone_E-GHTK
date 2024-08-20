<?php

namespace Modules\Product\Services;

use Illuminate\Database\Eloquent\Builder;

class ApplyOrderByService
{
    public function handle(Builder $query, ?string $orderBy): Builder
    {
        $sortOptions = [
            'price-asc' => 'sale_price ASC',
            'price-desc' => 'sale_price DESC',
            'rating' => 'rating DESC',
            'selling' => 'sold DESC',
            'latest' => 'created_at DESC',
        ];

        $query->orderByRaw($sortOptions[$orderBy] ?? 'created_at DESC');

        return $query;
    }
}