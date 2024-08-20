<?php
namespace Modules\Shop\Service\Shop;

use Illuminate\Support\Facades\Auth;
use Modules\Shop\Models\Shop;
use Modules\Shop\Models\User;

/**
 *
 */
class DeleteShopService {
    /**
     *
     */
    public function __construct() {
    }

    /**
     * @param $id
     * @return void
     * @throws \Exception
     */
    public function handle($id) : void
    {
//        if(!Auth::check()){
//            throw new \Exception("You must login");
//        }
        $userLogin = Auth::user() ?? User::first();

        $shop = Shop::query()->where('id', $id)->first();
        $shop->updated_by = $userLogin->id;
        $shop->save();
        $shop->delete();
    }
}
