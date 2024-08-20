<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Shop\DTO\Request\SearchProductRequest;
use Modules\Shop\DTO\Response\PaginateResponse;
use Modules\Shop\DTO\Response\ProductResponse;
use Modules\Shop\DTO\Response\ResponseListProduct;
use Modules\Shop\Models\Product;
use Mockery\Exception;

/**
 *
 */
class GetProductService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @param int $id
     * @return array
     */
    public function handle(int $id) : array
    {
        $shop = Session::get('shop');
        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }

        $product = Product::beLongsToShop($shop->id)
            ->where('id', $id)
            ->with('category', 'variants')
            ->first();

        if(is_null($product)){
            throw new Exception("Product not found");
        }

        $productResponse = new ProductResponse();
        $productResponse->setId($product->id);
        $productResponse->setName($product->name);
        $productResponse->setPrice($product->price);
        $productResponse->setSalePrice($product->sale_price);
        $productResponse->setSlug($product->slug);
        $productResponse->setCategoryId($product->category_id);
        $productResponse->setDescription($product->description);
        $productResponse->setVariants($product->variants->toArray());
        $productResponse->setThumbnail($product->thumbnail);

        return $productResponse->toArray();

    }
}
