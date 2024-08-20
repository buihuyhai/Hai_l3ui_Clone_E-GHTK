<?php
namespace Modules\Product\Services\Contracts;

interface ShopServiceInterface
{
    public function getShopById(int $id, ?string $categories, ?string $orderby, ?string $minPrice, ?string $maxPrice);
}