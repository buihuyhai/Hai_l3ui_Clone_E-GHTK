<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Shop\DTO\Request\SearchProductRequest;
use Modules\Shop\DTO\Response\PaginateResponse;
use Modules\Shop\DTO\Response\ProductResponse;
use Modules\Shop\DTO\Response\ResponseListProduct;
use Modules\Shop\DTO\Response\ShopResponse;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\User;
use SebastianBergmann\Type\MixedType;

/**
 *
 */
class GetProductsService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @param SearchProductRequest $request
     * @return array
     * @throws \Exception
     */
    public function handle(SearchProductRequest $request) : array
    {
        $shop = Session::get('shop');
        $pageList = [];
        $productResponse = null;
        if(!Auth::check() || $shop === null){
            throw new \Exception("You must login");
        }

        $products = Product::beLongsToShop($shop->id)
            ->with('category')
            ->withFilter($request)
            ->paginate($request->getPageSize());

        $productArray = $products->toArray();

        foreach ($productArray['links'] as $page){
            $pageList[] = (new PaginateResponse(
                $page['label'],
                $page['active'],
                (int) (explode("?page=", $page['url'] ?? "")[1] ?? null)
            ))->toArray();
        }


        foreach ($products as $product){
            $tmp = new ProductResponse();
            $tmp->setId($product->id);
            $tmp->setName($product->name);
            $tmp->setPrice($product->price);
            $tmp->setSold($product->sold);
            $tmp->setThumbnail($product->thumbnail);
            $tmp->setCategoryName($product->categoryName);
            $productResponse[] = $tmp->toArray();
        }

        return  (new ResponseListProduct(
            $productResponse,
            $productArray['total'],
            $productArray['current_page'],
            $productArray['last_page'],
            $productArray['per_page'],
            $pageList,
        ))->toArray();

    }
}
