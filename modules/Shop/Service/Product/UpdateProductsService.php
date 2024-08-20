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
class UpdateProductsService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @param ShopUpdateProductRequest $request
     * @return void
     */
    public function handle(ShopUpdateProductRequest $request) : void
    {
        $shop = Session::get('shop');
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }
        $userLogin = Auth::user()?? User::first();

        $update = [
            'name' => $request->getName(),
            'price' => $request->getPrice(),
            'sale_price' => $request->getSalePrice(),
            'short_desc' => "",
            'desciption' => $request->getDescription(),
            'slug' => $request->getSlug(),
            'category_id' => $request->getCategoryId(),
            'user_updated' => $userLogin->id,
        ];

        if ($request->getThumbnail() != ""){
            $update["thumbnail"] = $request->getThumbnail();
        }

        Product::beLongsToShop($shop->id)
            ->where('id', $request->getId())
            ->update($update);

    }
}
