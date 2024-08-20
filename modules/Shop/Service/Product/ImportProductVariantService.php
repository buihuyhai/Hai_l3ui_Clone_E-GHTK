<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\DTO\Request\ImportProductRequest;
use Modules\Shop\DTO\Request\ShopCreateProductRequest;
use Mockery\Exception;
use Modules\Shop\Models\HistoryImportProduct;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\User;

/**
 *
 */
class ImportProductVariantService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @param ImportProductRequest $request
     * @return void
     */
    public function handle(ImportProductRequest $request) : void
    {
        $shop = Session::get('shop');
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }

        $productVariant = ProductVariant::query()
            ->where('id', $request->getProductVariantId())
            ->whereHas('product', fn ($query) => $query->where('shop_id', $shop->id))
            ->first();

        if ($productVariant === null){
            throw new Exception("Product variant not found");
        }

        $productVariant->stock += $request->getNumber();
        $productVariant->save();

         HistoryImportProduct::create([
            'product_variant_id' => $request->getProductVariantId(),
            'number' => $request->getNumber(),
            'type' => $request->getType(),
        ]);


    }
}
