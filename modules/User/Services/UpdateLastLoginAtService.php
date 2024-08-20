<?php

namespace Modules\User\Services;

use Modules\Core\Services\BaseService;
use Modules\User\Models\User;

class UpdateLastLoginAtService extends BaseService
{
    public function __construct()
    {
    }

    //Handle Update User Last Login At
    public function handle(int $id): array
    {
        $user = User::find($id);

        if (!$user)
            return $this->responseData(false);

        $user->last_login_at = now();

        return $this->responseData($user->save());

    }

}

