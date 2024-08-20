<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\DTO\Request\ShopCreateProductRequest;
use Mockery\Exception;
use Modules\Shop\DTO\Request\ShopCreateVariantRequest;
use Modules\Shop\DTO\Request\ShopUpdateVariantRequest;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\User;
use Modules\Shop\Request\ActionVariantRequest;

/**
 *
 */
class UpdateVariantService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @param ShopUpdateVariantRequest $request
     * @param $id
     * @return void
     */
    public function handle(ShopUpdateVariantRequest $request, $id) : void
    {
        $shop = Session::get('shop');
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }
        $userLogin = Auth::user()?? User::first();

        $product = Product::beLongsToShop($shop->id)
            ->where('id', $id)
            ->with( 'variants')
            ->first();

        if(is_null($product)){
            throw new Exception("Product not found");
        }
        $product->user_updated = $userLogin->id;
        $product->save();

        ProductVariant::query()
            ->where('id', $request->getId())
            ->where('product_id', $product->id)
            ->update([
                'name' => $request->getName(),
                'price' => $request->getPrice(),
                'sale_price' => $request->getSalePrice(),
                'import_price' => $request->getImportPrice(),
            ]);
    }
}
