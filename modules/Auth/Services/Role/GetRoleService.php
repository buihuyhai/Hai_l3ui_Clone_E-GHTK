<?php

namespace Modules\Auth\Services\Role;

use Modules\Core\Services\BaseService;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Modules\Auth\Hooks\RoleHook;


class GetRoleService extends BaseService
{
    public function __construct()
    {

    }

    public function getAllRole()
    {
        return $this->responseData(true, Role::all());
    }

    public function getRolesExceptSuperAdmin()
    {
        return $this->responseData(true,
            Role::query()
                ->where('name', '<>', RoleHook::SUPER_ADMIN)
                ->get()
        );
    }

    public function getRoleByName(string $name = ""): array
    {
        if (!$name) return $this->responseData(false);
        return $this->responseData(true, Role::where("name", $name)->first());
    }

    public function getRoleNameByUserId(int $id): array
    {
        $user = User::find($id);

        if (!$user) return $this->responseData(false);

        return $this->responseData(true, [
            "role" => $user?->roles()?->first()?->name
        ]);
    }

}
