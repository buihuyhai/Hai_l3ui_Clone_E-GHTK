<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\DTO\Request\ShopCreateProductRequest;
use Mockery\Exception;
use Modules\Shop\DTO\Request\ShopUpdateProductRequest;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\User;

/**
 *
 */
class DeleteProductsService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @param $id
     * @return void
     */
    public function handle($id) : void
    {
        $shop = Session::get('shop');
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }

        Product::beLongsToShop($shop->id)
            ->where('id', $id)
            ->delete();

    }
}
