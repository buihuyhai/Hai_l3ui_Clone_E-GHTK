<?php
namespace Modules\Shop\Service\Shop;

use Illuminate\Support\Facades\Auth;
use Modules\Shop\DTO\Request\UpdateShopRequest;
use Modules\Shop\Models\Shop;
use Modules\Shop\Models\User;

/**
 *
 */
class UpdateShopService {
    /**
     */
    public function __construct() {
    }


    /**
     * @param UpdateShopRequest $request
     * @param $id
     * @return void
     * @throws \Exception
     */
    public function handle(UpdateShopRequest $request, $id) : void
    {
        if(!Auth::check()){
            throw new \Exception("You must login");
        }

        $userLogin = Auth::user() ?? User::first();
        $request->setUpdatedBy($userLogin->id);
        Shop::query()->where('id', $id)->update($request->toArray());

    }
}
