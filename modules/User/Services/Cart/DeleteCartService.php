<?php

namespace Modules\User\Services\Cart;

use Modules\Cart\Models\Cart;
use Modules\Core\Services\BaseService;
use Exception;

class DeleteCartService extends BaseService
{
    public function __construct()
    {
    }

    //Handle Delete Cart Service
    public function deleteCartById(int $id)
    {
        try {
            $cart = Cart::find($id);

            return $this->responseData($cart->delete());
        } catch (Exception $e) {
            return $this->responseData(false);
        }
    }

    public function deleteCartByUserId(int $userId): array
    {
        try {
            return $this->responseData(Cart::where('user_id', $userId)->delete());
        } catch (Exception $e) {
            return $this->responseData(false);
        }
    }


}
