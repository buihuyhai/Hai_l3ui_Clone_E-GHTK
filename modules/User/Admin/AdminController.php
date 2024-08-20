<?php

namespace Modules\User\Admin;

use Illuminate\Http\Request;
use Modules\Auth\Hooks\RoleHook;
use Modules\Media\Helpers\FileHelper;
use Modules\User\Requests\AdminRequest;
use Modules\User\Services\ChangeLockAccountService;
use Modules\User\Services\CreateUserService;
use Modules\User\Services\DeleteUserService;
use Modules\User\Services\GetUserService;
use Modules\User\Services\UpdateUserService;
use Modules\Media\Services\File\UploadFileService;
use Modules\Core\Admin\BaseController;
use Modules\User\Traits\UserRequestTrait;

class AdminController extends BaseController
{
    use UserRequestTrait;

    protected ChangeLockAccountService $changeLockAccountService;
    protected CreateUserService $createUserService;
    protected UpdateUserService $updateUserService;
    protected DeleteUserService $deleteUserService;
    protected GetUserService $getUserService;
    private $role = RoleHook::ADMIN ?? 'admin';

    public function __construct(
        ChangeLockAccountService $changeLockAccountService,
        UploadFileService        $uploadFileService,
        CreateUserService        $createUserService,
        UpdateUserService        $updateUserService,
        DeleteUserService        $deleteUserService,
        GetUserService           $getUserService
    )
    {
        $this->middleware('can:manage_admin');

        $this->changeLockAccountService = $changeLockAccountService;
        $this->uploadFileService = $uploadFileService;
        $this->createUserService = $createUserService;
        $this->updateUserService = $updateUserService;
        $this->deleteUserService = $deleteUserService;
        $this->getUserService = $getUserService;
    }

    public function index(Request $request)
    {
        $this->checkPermission('view_admin');
        $response = $this->getUserService->getUsersFilterByRole($request, $this->role);

        $data = [
            'rows'        => $response['data'],
            "page_title"  => __("Quản trị viên"),
            "breadcrumbs" => [
                [
                    "name"  => __("Quản trị viên"),
                    "class" => "active"
                ]
            ],
        ];
        return view("User::admin.admin.index", $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('create_admin');
        $data = [
            "page_title"  => __("Thêm quản trị viên"),
            "breadcrumbs" => [
                [
                    "name" => __("Quản trị viên"),
                    "url"  => route("user.admin.admin.index")
                ],
                [
                    "name"  => __("Thêm quản trị viên"),
                    "class" => "active"
                ],
            ],
        ];
        return view("User::admin.admin.detail", $data);
    }

    public function update(Request $request, int $id)
    {
        $this->checkPermission('update_admin');
        if (!$id) abort(404);

        $response = $this->getUserService->getUserById($id);

        if (!$response['status']) abort(400);

        $data = [
            "row"         => $response['data'],
            "page_title"  => __("Cập nhật thông tin"),
            "breadcrumbs" => [
                [
                    "name" => __("Quản trị viên"),
                    "url"  => route("user.admin.admin.index")
                ],
                [
                    "name"  => __("Cập nhật thông tin"),
                    "class" => "active"
                ],
            ],
        ];
        return view("User::admin.admin.detail", $data);
    }

    public function handleCreate(AdminRequest $request)
    {
        $this->checkPermission('create_admin');

        $data = [
            "avatar" => FileHelper::DEFAULT_AVATAR,
            ...($request->validated()),
            ...($this->getRequestOrRandomData($request)),
            'role'   => $this->role
        ];

        $response = $this->createUserService->handle($data);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return redirect(route("user.admin.admin.index"))
            ->with("success", "Thêm thành công");
    }

    public function handleUpdate(AdminRequest $request, int $id)
    {
        $this->checkPermission('update_admin');

        if (!$id) abort(404);

        $data = [
            ...($request->validated()),
            ...($this->getRequestOrRandomData($request)),
        ];

        $response = $this->updateUserService->handle($data, $id);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return redirect(route("user.admin.admin.index"))
            ->with("success", "Cập nhật thành công");
    }


}
