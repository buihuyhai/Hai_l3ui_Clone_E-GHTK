<?php
namespace Modules\Shop\Service\Shop;

use Illuminate\Support\Facades\Auth;
use Modules\Shop\DTO\Request\RegisterShopRequest;
use Modules\Shop\DTO\Response\RegisterShopResponse;
use Modules\Shop\Enum\StatusShopEnum;
use Modules\Shop\Models\User;
use Modules\Shop\Repositories\Contracts\ShopRepositoryInterface;
use Modules\Shop\Repositories\Eloquent\ShopRepository;

/**
 *
 */
class RegisterShopService {
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

    public function handle(RegisterShopRequest $request) : RegisterShopResponse
    {
        if(!Auth::check()){
            throw new \Exception("You must login");
        }

        $userLogin = Auth::user() ?? User::first();

        if($request->getOwner() === null){
            $request->setOwner($userLogin->id);
        }
        $request->setStatus(StatusShopEnum::STATUS_OPEN);


//        if(true) // check user login is  admin
//        {
//            $request->setIsConfirmed(true);
//        }
//        else {
            $request->setIsConfirmed(true);
//        }

        $request->setCreatedBy($userLogin->id);
        $request->setUpdatedBy($userLogin->id);
        $shopModel = $this->shopRepository->createShop($request);
        return RegisterShopResponse::withAllArguments(
            $shopModel->id,
            $shopModel->name,
        );
    }
}
