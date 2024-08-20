<?php

namespace Modules\User\Services\Cart;

use Modules\Core\Services\BaseService;
use Modules\Cart\Models\Cart;
use Exception;

class CreateCartService extends BaseService
{
    public function __construct()
    {
    }

    public function handle(array $data): array
    {
        try {

            $cart = Cart::create($data);

            return $this->responseData(true, $cart);

        } catch (Exception $e) {
            return $this->responseData(false);
        }
    }


}
