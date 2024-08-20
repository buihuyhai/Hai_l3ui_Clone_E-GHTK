<?php

namespace Modules\Auth\Services\Permission;

use Modules\Auth\Services\Role\GetRoleService;
use Modules\Core\Services\BaseService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class GetPermissionService extends BaseService
{
    protected GetRoleService $getRoleService;

    public function __construct(GetRoleService $getRoleService)
    {
        $this->getRoleService = $getRoleService;
    }

    public function getAllPermission(): array
    {
        return $this->responseData(true, Permission::all());
    }

    public function getAllPermissionName(): array
    {
        return $this->responseData(true, Permission::all()->pluck('name'));
    }

    public function getPermissionsOfRoles(): array
    {
        $roles = ($this->getRoleService->getAllRole())['data'];
        $permissionsOfRoles = [];
        foreach ($roles as $role) {
            $permissionsOfRoles[$role->id] = $role->permissions()->pluck('name')->all();
        }
        return $this->responseData(true, $permissionsOfRoles);
    }

    public function getPermissionsOfRolesExceptSuperAdmin(): array
    {
        $roles = ($this->getRoleService->getRolesExceptSuperAdmin())['data'];
        $permissionsOfRoles = [];
        foreach ($roles as $role) {
            $permissionsOfRoles[$role->id] = $role->permissions()->pluck('name')->all();
        }
        return $this->responseData(true, $permissionsOfRoles);
    }

    public function getPermissionsFromRoleName(string $name = ""): array
    {
        if (!$name) return $this->responseData(false);
        return $this->responseData(true,
            Role::where('name', $name)
                ->first()
                ->permissions()
                ->pluck('name')->all()
        );
    }


}
