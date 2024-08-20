<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\DTO\Request\ShopCreateProductRequest;
use Mockery\Exception;
use Modules\Shop\DTO\Request\ShopCreateVariantRequest;
use Modules\Shop\Enum\TypeImportProductEnum;
use Modules\Shop\Models\HistoryImportProduct;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\User;
use Modules\Shop\Request\ActionVariantRequest;

/**
 *
 */
class DeleteVariantService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @param $idVariant
     * @param $id
     * @return void
     */
    public function handle($idVariant, $id) : void
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

        $productVariant = ProductVariant::query()
            ->where('id', $idVariant)
            ->where('product_id', $product->id)
            ->first();

        $stock = $productVariant->stock;
        if($stock > 0){
            $productVariant->stock = 0;
            $productVariant->save();
            HistoryImportProduct::create([
                'product_variant_id' => $idVariant,
                'type' => TypeImportProductEnum::TYPE_DELETE_VARIANT,
                'number' => -$stock,
            ]);
        }

    }
}
