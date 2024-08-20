<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\Core\Services\BaseService;
use Modules\User\Models\User;
use Exception;

class UpdateUserService extends BaseService
{
    public function __construct()
    {
    }

    //Handle Update User
    public function handle(array $data, int $id)
    {
        try {
            User::where("id", $id)->update($data);

            return $this->responseData(true);
        } catch (Exception $e) {
            return $this->responseData(false, [
                "message" => $e->getMessage()
            ]);
        }
    }


}

