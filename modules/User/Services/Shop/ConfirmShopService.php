<?php

namespace Modules\User\Services\Shop;

use Modules\Core\Services\BaseService;
use Modules\Shop\Models\Shop;

class ConfirmShopService extends BaseService
{
    public function __construct()
    {
    }

    public function handle(int $id)
    {
        $shop = Shop::find($id);

        if (!$shop) return $this->responseData(false);

        $shop->is_confirmed = true;

        return $this->responseData($shop->save(),
            [
                'message' => "Xác nhận Shop thành công!",
            ]
        );
    }


}
