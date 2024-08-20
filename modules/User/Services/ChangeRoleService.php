<?php

namespace Modules\User\Services;

use Modules\Core\Services\BaseService;
use Modules\User\Models\User;

class ChangeRoleService extends BaseService
{
    public function __construct()
    {
    }

    //Handle Change Role
    public function handle(string $role, int $id)
    {
        $user = User::find($id);

        if (!$user)
            return $this->responseData(false);

        $user->syncRoles([$role]);

        return $this->responseData(true);
    }


}
