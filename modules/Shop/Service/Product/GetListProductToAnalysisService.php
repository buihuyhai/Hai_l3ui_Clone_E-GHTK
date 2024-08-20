<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
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
class GetListProductToAnalysisService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @return array
     */
    public function handle() : array
    {
        $shop = Session::get('shop');
        $result = [];

        if(!Auth::check() || $shop === null){
            throw new Exception("You must login");
        }

        $products = Product::beLongsToShop($shop->id)
            ->with('variants')
            ->get();



        foreach ($products as $product){
            foreach ($product->variants as $variant){
                $result[] = [
                    'id' => $variant->id,
                    'name' => $product->name . "-" . $variant->name
                ];
            }
        }

        return $result;

    }
}
