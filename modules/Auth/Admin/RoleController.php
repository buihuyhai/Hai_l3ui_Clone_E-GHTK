<?php

namespace Modules\Auth\Admin;

use Modules\Auth\Services\Role\GetRoleService;

class RoleController
{
    protected GetRoleService $getRoleService;

    public function __construct(GetRoleService $getRoleService)
    {
        $this->getRoleService = $getRoleService;
    }

    public function index()
    {
        $data = [
            'rows'        => ($this->getRoleService->getRolesExceptSuperAdmin())['data'],
            "page_title"  => __("Vai trò"),
            "breadcrumbs" => [
                [
                    "name"  => __("Vai trò"),
                    "class" => "active"
                ]
            ],
        ];


        return view("Auth::admin.role.index", $data);
    }


}
