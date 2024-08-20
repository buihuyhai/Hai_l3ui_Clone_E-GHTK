<?php

namespace Modules\User\Services\Shop;

use Modules\Core\Services\BaseService;
use Exception;
use Modules\Shop\Models\Shop;

class UpdateShopService extends BaseService
{
    public function __construct()
    {
    }

    public function handle(array $data, int $id)
    {
        try {
            Shop::where('id', $id)->update($data);

            return $this->responseData(true, Shop::find($id));
        } catch (Exception $e) {
            return $this->responseData(false,
                [
                    "message" => $e->getMessage()
                ]
            );
        }
    }

}
