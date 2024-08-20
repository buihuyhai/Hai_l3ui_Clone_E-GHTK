<?php

namespace Modules\Auth\Services\Permission;

use Modules\Auth\Services\Role\GetRoleService;
use Modules\Core\Services\BaseService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UpdatePermissionService extends BaseService
{
    protected GetRoleService $getRoleService;

    public function __construct(GetRoleService $getRoleService)
    {
        $this->getRoleService = $getRoleService;
    }

    public function handle($matrix)
    {

        $roles = ($this->getRoleService->getAllRole())['data'];
        foreach ($roles as $role) {
            if (empty($matrix[$role->id])) {
                $role->syncPermissions();
                continue;
            }
            $role->syncPermissions($matrix[$role->id]);
        }
        return $this->responseData(true);
    }


}
