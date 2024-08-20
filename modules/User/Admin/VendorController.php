<?php

namespace Modules\User\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Hooks\RoleHook;
use Modules\Core\Admin\BaseController;
use Modules\Media\Helpers\FileHelper;
use Modules\User\Requests\AdminRequest;
use Modules\User\Requests\UserRequest;
use Modules\User\Services\ChangeLockAccountService;
use Modules\User\Services\CreateUserService;
use Modules\User\Services\DeleteUserService;
use Modules\User\Services\GetUserService;
use Modules\User\Services\UpdateUserService;
use Modules\Media\Services\File\UploadFileService;
use Modules\User\Traits\UserRequestTrait;

class VendorController extends BaseController
{
    use UserRequestTrait;

    protected GetUserService $getUserService;
    protected CreateUserService $createUserService;
    protected UpdateUserService $updateUserService;
    protected DeleteUserService $deleteUserService;
    protected ChangeLockAccountService $changeLockAccountService;
    private $role = RoleHook::VENDOR ?? 'vendor';

    public function __construct(
        GetUserService           $getUserService,
        UploadFileService        $uploadFileService,
        CreateUserService        $createUserService,
        UpdateUserService        $updateUserService,
        DeleteUserService        $deleteUserService,
        ChangeLockAccountService $changeLockAccountService
    )
    {
        $this->middleware('can:manage_vendor');

        $this->getUserService = $getUserService;
        $this->createUserService = $createUserService;
        $this->uploadFileService = $uploadFileService;
        $this->updateUserService = $updateUserService;
        $this->deleteUserService = $deleteUserService;
        $this->changeLockAccountService = $changeLockAccountService;
    }

    public function index(Request $request)
    {
        $this->checkPermission('view_vendor');

        $response = $this->getUserService->getUsersFilterByRole($request, 'vendor');

        $data = [
            'rows'        => $response['data'],
            "page_title"  => __("Người bán"),
            "breadcrumbs" => [
                [
                    "name"  => __("Người bán"),
                    "class" => "active"
                ]
            ],
        ];
        return view("User::admin.vendor.index", $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('create_vendor');
        $data = [
            "page_title"  => __("Thêm người bán"),
            "breadcrumbs" => [
                [
                    "name" => __("Người bán"),
                    "url"  => route("user.admin.vendor.index")
                ],
                [
                    "name"  => __("Thêm người bán"),
                    "class" => "active"
                ],
            ],
        ];
        return view("User::admin.vendor.detail", $data);
    }

    public function update(Request $request, int $id)
    {
        $this->checkPermission('update_vendor');

        if (!$id) abort(404);

        $response = $this->getUserService->getUserById($id);
        if (!$response['status']) abort(400);

        $row = $response['data'];

        $data = [
            "row"         => $row,
            "page_title"  => __("Sửa người bán"),
            "breadcrumbs" => [
                [
                    "name" => __("Người bán"),
                    "url"  => route("user.admin.vendor.index")
                ],
                [
                    "name"  => __("Sửa người bán"),
                    "class" => "active"
                ],
            ],
        ];
        return view("User::admin.vendor.detail", $data);
    }

    public function handleCreate(AdminRequest $request)
    {
        $this->checkPermission('view_vendor');

        $data = [
            "avatar" => FileHelper::DEFAULT_AVATAR,
            ...($request->validated()),
            ...($this->getRequestOrRandomData($request)),
            'role'   => $this->role
        ];

        $response = $this->createUserService->handle($data);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return redirect(route("user.admin.vendor.index"))
            ->with("success", "Thêm thành công");
    }

    public function handleUpdate(AdminRequest $request, int $id)
    {
        $this->checkPermission('update_vendor');

        if (!$id) abort(404);

        $data = [
            ...($request->validated()),
            ...($this->getRequestOrRandomData($request)),
        ];

        $response = $this->updateUserService->handle($data, $id);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return redirect(route("user.admin.vendor.index"))
            ->with("success", "Cập nhật thành công");
    }

}
