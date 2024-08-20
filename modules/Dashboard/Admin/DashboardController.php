<?php

namespace Modules\Dashboard\Admin;

use Modules\User\Services\GetUserService;
use Modules\User\Services\Shop\GetShopService;
use Modules\Auth\Hooks\RoleHook;

class DashboardController
{
    protected GetUserService $getUserService;
    protected GetShopService $getShopService;
    private $limit;

    public function __construct(
        GetShopService $getShopService,
        GetUserService $getUserService
    )
    {
        $this->getUserService = $getUserService;
        $this->getShopService = $getShopService;
        $this->limit = config("response.pagination.limit");
    }

    public function index()
    {
        $data = [
            "page_title"  => __("Trang Chủ"),
            "breadcrumbs" => [
                [
                    "name"  => __("Dashboard"),
                    "class" => "active",
                ]
            ],
        ];

        return view("Dashboard::admin.index", $data);
    }


}
