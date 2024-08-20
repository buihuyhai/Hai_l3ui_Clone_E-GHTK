<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\Cart\Models\Cart;
use Modules\Core\Services\BaseService;
use Modules\User\Models\User;
use Exception;

class BulkActionUserService extends BaseService
{
    public function __construct()
    {
    }

    //Handle Bulk Delete
    public function handleBulkDelete(array $ids)
    {
        try {
            DB::transaction(function () use ($ids) {
                Cart::whereIn('user_id', $ids)->delete();

                User::whereIn('id', $ids)->delete();
            });
            return $this->responseData(true);
        } catch (Exception $e) {
            return $this->responseData(false);
        }
    }


}
