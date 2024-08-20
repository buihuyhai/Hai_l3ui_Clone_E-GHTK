<?php
namespace Modules\Shop\Service\Shop;

use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Shop\DTO\Response\OwnerResponse;
use Modules\Shop\DTO\Response\ShopResponse;
use Modules\Shop\Models\User;
use Modules\Shop\Repositories\Contracts\ShopRepositoryInterface;
use Modules\Shop\Repositories\Eloquent\ShopRepository;

/**
 *
 */
class GetShopService {
    /**
     * @var ShopRepository|ShopRepositoryInterface
     */
    private ShopRepositoryInterface|ShopRepository $shopRepository;

    /**
     * @param ShopRepository $shopRepository
     */
    public function __construct(ShopRepository $shopRepository) {
        $this->shopRepository = $shopRepository;
    }

    /**
     * @param $id
     * @return ShopResponse|null
     * @throws Exception
     */
    public function handle($id) : ShopResponse|null
    {
        $isAdmin = false;
        if(!Auth::check()){
            throw new Exception("You must login");
        }

        $userLogin = Auth::user() ?? User::first();
//        $isAdmin = $userLogin->isAdmin() ?? false;
        $shop = $this->shopRepository->getShop($id, $userLogin->id, $isAdmin);
        if(is_null($shop)){
            return null;
        }

        $owner = $shop->owner()->first();
        $ownerRs = OwnerResponse::withAllArguments(
            $owner->id,
            $owner->firstName,
            $owner->lastName,
            $owner->name,
            $owner->phone_number,
        );
        return ShopResponse::withAllArguments(
            $shop->id,
            $shop->name,
            $shop->description,
            $shop->address,
            $shop->phone_number,
            $shop->email,
            $shop->status_name,
            $shop->logo_url,
            $ownerRs
        );
    }
}
