<?php

namespace Modules\User\Admin;

use Illuminate\Http\Request;
use Modules\Auth\Hooks\RoleHook;
use Modules\Auth\Services\Role\GetRoleService;
use Modules\Core\Admin\BaseController;
use Modules\Core\Hooks\BulkActionHook;
use Modules\User\Services\BulkActionUserService;
use Modules\User\Services\ChangeLockAccountService;
use Modules\User\Services\CreateUserService;
use Modules\User\Services\DeleteUserService;
use Modules\User\Services\GetUserService;
use Modules\User\Services\UpdateUserService;

class UserController extends BaseController
{
    protected GetUserService $getUserService;
    protected GetRoleService $getRoleService;
    protected CreateUserService $createUserService;
    protected UpdateUserService $updateUserService;
    protected DeleteUserService $deleteUserService;
    protected BulkActionUserService $bulkActionUserService;
    protected ChangeLockAccountService $changeLockAccountService;

    public function __construct(
        GetUserService           $getUserService,
        GetRoleService           $getRoleService,
        CreateUserService        $createUserService,
        UpdateUserService        $updateUserService,
        DeleteUserService        $deleteUserService,
        BulkActionUserService    $bulkActionUserService,
        ChangeLockAccountService $changeLockAccountService
    )
    {
        $this->middleware("can:manage_customer,manage_vendor,manage_admin");

        $this->getUserService = $getUserService;
        $this->getRoleService = $getRoleService;
        $this->createUserService = $createUserService;
        $this->updateUserService = $updateUserService;
        $this->deleteUserService = $deleteUserService;
        $this->bulkActionUserService = $bulkActionUserService;
        $this->changeLockAccountService = $changeLockAccountService;
    }

    public function index(Request $request)
    {
        $response = $this->getUserService->getUsersFilter($request);
        $data = [
            "rows"        => $response["data"],
            "page_title"  => __("Tất cả"),
            "roles"       => ($this->getRoleService->getAllRole())["data"],
            "breadcrumbs" => [
                [
                    "name"  => __("Tất cả"),
                    "class" => "active"
                ]
            ],
        ];
        return view("User::admin.index", $data);
    }

    public function handleChangeLockAccount(Request $request, int $id)
    {
        if (!$id) abort(404);

        $role = $this->getRoleName($id);

        $this->checkPermission("lock_{$role}");

        $response = $this->changeLockAccountService->handle($id);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra!");

        return back()
            ->with("success", $response['data']['message'] ?? 'Thành công!');
    }

    public function delete(Request $request, int $id)
    {
        if (!$id) abort(404);

        $role = $this->getRoleName($id);

        $this->checkPermission("delete_{$role}");

        $response = $this->deleteUserService->handle($id);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return back()
            ->with("success", "Xóa thành công!");
    }

    private function getRoleName(int $id)
    {
        $response = $this->getRoleService->getRoleNameByUserId($id);

        if (!$response['status']) abort(404);

        return $response['data']['role'];
    }

    public function handleBulkAction(Request $request)
    {
        $this->middleware("can:manage_customer,manage_vendor,manage_admin");

        if (!$request->action) return back()->with("error", "Hành động không hợp lệ!");

        if (!$request->ids) return back()->with("error", "Dữ liệu không được để trống!");

        switch ($request->action) {
            case BulkActionHook::DELETE:
            {
                $response = $this->bulkActionUserService->handleBulkDelete($request->ids);

                if (!$response['status'])
                    return back()->with("error", "Đã có lỗi xảy ra!");

                return back()->with("success", "Xóa thành công!");
            }
            default:
            {
                return back()->with("error", "Đã có lỗi xảy ra!");
            }
        }
    }

}
