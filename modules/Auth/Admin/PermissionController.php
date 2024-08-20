<?php

namespace Modules\Auth\Admin;

use Illuminate\Http\Request;
use Modules\Auth\Hooks\RoleHook;
use Modules\Auth\Services\Permission\GetPermissionService;
use Modules\Auth\Services\Permission\UpdatePermissionService;
use Modules\Auth\Services\Role\GetRoleService;
use Modules\Auth\Helpers\PermissionHelper;

class PermissionController
{
    protected UpdatePermissionService $updatePermissionService;
    protected GetPermissionService $getPermissionService;
    protected GetRoleService $getRoleService;

    public function __construct(
        UpdatePermissionService $updatePermissionService,
        GetPermissionService    $getPermissionService,
        GetRoleService          $getRoleService
    )
    {
        $this->updatePermissionService = $updatePermissionService;
        $this->getPermissionService = $getPermissionService;
        $this->getRoleService = $getRoleService;
    }

    public function permissionMatrix(Request $request)
    {
        $data = [
            'permissionsGroup' => PermissionHelper::all(),
            "selectedIds"      => ($this->getPermissionService->getPermissionsOfRoles())['data'],
            'roles'            => ($this->getRoleService->getRolesExceptSuperAdmin())['data'],
            "page_title"       => __("Phân quyền"),
            "breadcrumbs"      => [
                [
                    "name"  => __("Phân quyền"),
                    "class" => "active"
                ]
            ],
        ];

        return view("Auth::admin.permission.index", $data);
    }

    public function updatePermissionMatrix(Request $request)
    {
        $matrix = $request->input("matrix");

        $matrix = is_array($matrix) ? $matrix : [];

        $superAdmin = $this->getPermissionsOfSuperAdmin();

        $matrix[$superAdmin->id] = $this->getPermissionService->getPermissionsFromRoleName($superAdmin->name)['data'];

        $this->updatePermissionService->handle($matrix);

        return back()->with('success', __("Cập nhật quyền hạn thành công!"));
    }

    public function getPermissionsOfSuperAdmin()
    {
        $response = $this->getRoleService->getRoleByName(RoleHook::SUPER_ADMIN);

        if (!$response['status'])
            abort(400);

        return $response['data'];
    }

}
