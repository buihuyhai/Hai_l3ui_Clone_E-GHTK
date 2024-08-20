<?php

namespace Modules\User\Services\Shop;

use Modules\Core\Services\BaseService;
use Exception;
use Modules\Shop\Models\Shop;
use Modules\Shop\Enum\StatusShopEnum;

class ChangeStatusShopService extends BaseService
{
    public function __construct()
    {
    }

    public function handle(int $id, int $status)
    {
        try {
            $shop = Shop::find($id);

            $shop->status = $status;

            return $this->responseData($shop->save());
        } catch (Exception $e) {
            return $this->responseData(false,
                [
                    "message" => $e->getMessage()
                ]
            );
        }
    }

}
