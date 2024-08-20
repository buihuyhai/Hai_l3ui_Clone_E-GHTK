<?php

namespace Modules\Shop\Repositories\Eloquent;

use Modules\Shop\DTO\Request\RegisterShopRequest;
use Modules\Shop\DTO\Request\UpdateShopRequest;
use Modules\Shop\Models\Shop;
use Modules\Shop\Repositories\Contracts\ShopRepositoryInterface;

/**
 *
 */
class ShopRepository implements ShopRepositoryInterface
{

    /**
     * @var Shop
     */
    private Shop $shop;

    /**
     * @param Shop $shop
     */
    public function __construct(Shop $shop){
        $this->shop = $shop;
    }
    /**
     * @param RegisterShopRequest $request
     * @return Shop
     */
    public function createShop(RegisterShopRequest $request): Shop
    {
        $shopCreated =  $this->shop->create($request->toArray());
        $shopCreated->owner()->attach($request->getOwner());
        return $shopCreated;
    }


    /**
     * @param int $id
     * @param int $owner
     * @param bool $isAdmin
     * @return Shop|null
     */
    public function getShop(int $id, int $owner, bool $isAdmin): ?Shop
    {
        $queryShop = Shop::query()->where('id', $id);
        if (!$isAdmin){
            $queryShop->whereHas(
                'owner', fn($query) => $query->where('users.id', $owner)
            );
        }
        return $queryShop->first();
    }
}
