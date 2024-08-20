<?php

namespace Modules\Shop\Repositories\Contracts;

use Modules\Shop\DTO\Request\RegisterShopRequest;
use Modules\Shop\DTO\Request\UpdateShopRequest;
use Modules\Shop\DTO\Response\ShopResponse;
use Modules\Shop\Models\Shop;

interface ShopRepositoryInterface
{

    /**
     * @param RegisterShopRequest $request
     * @return Shop
     */
    public function createShop(RegisterShopRequest $request) : Shop;


    /**
     * @param int $id
     * @param int $owner
     * @param bool $isAdmin
     * @return Shop|null
     */
    public function getShop(int $id, int $owner, bool $isAdmin) : ?Shop;



}
