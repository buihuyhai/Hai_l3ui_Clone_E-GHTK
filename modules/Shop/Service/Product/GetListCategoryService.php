<?php
namespace Modules\Shop\Service\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Product\Models\Category;
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
class GetListCategoryService {
    /**
     *
     */
    public function __construct() {
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function handle() : mixed
    {
        return Category::get();
    }
}
