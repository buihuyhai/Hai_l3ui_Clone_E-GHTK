<?php

namespace Modules\User\Services\Shop;

use Illuminate\Support\Facades\DB;
use Modules\Core\Services\BaseService;
use Modules\Shop\Models\Shop;
use Modules\Shop\Enum\StatusShopEnum;
use Exception;

class BulkActionShopService extends BaseService
{
    public function __construct()
    {
    }

    public function handleBulkStatus(array $ids, int $status)
    {
        try {
            Shop::whereIn('id', $ids)->update(['status' => $status]);
            return $this->responseData(true,
                [
                    "message" => "Thay đổi trạng thái thành công!"
                ]
            );
        } catch (Exception $e) {
            return $this->responseData(false,
                [
                    "message" => $e->getMessage()
                ]
            );
        }
    }

    public function handleBulkConfirm(array $ids)
    {
        try {
            Shop::whereIn('id', $ids)->update(['is_confirmed' => true]);
            return $this->responseData(true,
                [
                    "message" => "Xác nhận thành công!"
                ]
            );
        } catch (Exception $e) {
            return $this->responseData(false,
                [
                    "message" => $e->getMessage()
                ]
            );
        }
    }

}
