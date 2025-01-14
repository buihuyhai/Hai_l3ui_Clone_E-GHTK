<?php
namespace Modules\Shop\Service\Shop;

use Illuminate\Support\Facades\Auth;
use Modules\Shop\Models\Shop;
use Modules\Shop\Models\User;

/**
 *
 */
class ConfirmShopService {
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
        if(!Auth::check()){
            throw new \Exception("You must login");
        }
        $userLogin = Auth::user() ?? User::first();
//      check admin
//        if(!$userLogin->isAdmin()){
//            throw new \Exception("You must login");
//        }
        Shop::where('id', $id)->update([
            'updated_by' => $userLogin->id,
            'is_confirmed' => true
        ]);
    }
}
