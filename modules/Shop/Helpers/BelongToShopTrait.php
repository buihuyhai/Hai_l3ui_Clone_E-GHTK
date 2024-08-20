<?php

namespace Modules\Shop\Helpers;
trait BelongToShopTrait
{
    /**
     * @param $query
     * @param $shop
     * @return mixed
     */
    public function scopeBeLongsToShop($query, $shop): mixed
    {
        return $query->where("shop_id", $shop);
    }

}
