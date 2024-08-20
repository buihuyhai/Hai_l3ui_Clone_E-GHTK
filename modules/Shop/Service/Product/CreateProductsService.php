<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\DTO\Request\ShopCreateProductRequest;
use Mockery\Exception;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\User;

/**
 *
 */
class CreateProductsService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @param ShopCreateProductRequest $request
     * @return void
     */
    public function handle(ShopCreateProductRequest $request) : void
    {
        $shop = Session::get('shop');
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }
        $userLogin = Auth::user()?? User::first();
        $product = Product::create([
            'name' => $request->getName(),
            'price' => $request->getPrice(),
            'sale_price' => $request->getSalePrice(),
            'short_desc' => "",
            'desciption' => $request->getDescription(),
            'slug' => $request->getSlug(),
            'thumbnail' => $request->getThumbnail(),
            'category_id' => $request->getCategoryId(),
            'shop_id' => $shop->id,
            'user_created' => $userLogin->id,
            'user_updated' => $userLogin->id,
        ]);
        $variants = $request->getVariant();
        foreach ($variants as &$variant) {
            $variant['product_id'] = $product->id;
            $variant['stock'] = 0;
            $variant['media_id'] = 0;
        }

        ProductVariant::query()->insert($variants);

    }
}
