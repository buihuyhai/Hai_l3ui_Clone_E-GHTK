<?php

namespace Modules\User\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Hooks\RoleHook;
use Modules\Core\Admin\BaseController;
use Modules\Media\Helpers\FileHelper;
use Modules\Media\Services\File\UploadFileService;
use Modules\User\Requests\AdminRequest;
use Modules\User\Services\CreateUserService;
use Modules\User\Services\DeleteUserService;
use Modules\User\Services\GetUserService;
use Modules\User\Services\UpdateUserService;
use Modules\User\Services\ChangeLockAccountService;
use Modules\User\Traits\UserRequestTrait;

class CustomerController extends BaseController
{
    use UserRequestTrait;

    protected GetUserService $getUserService;
    protected CreateUserService $createUserService;
    protected UpdateUserService $updateUserService;
    protected DeleteUserService $deleteUserService;
    protected ChangeLockAccountService $changeLockAccountService;

    private $role = RoleHook::CUSTOMER ?? 'customer';

    public function __construct(
        GetUserService           $getUserService,
        UploadFileService        $uploadFileService,
        CreateUserService        $createUserService,
        UpdateUserService        $updateUserService,
        DeleteUserService        $deleteUserService,
        ChangeLockAccountService $changeLockAccountService
    )
    {

        $this->middleware(['can:manage_customer']);

        $this->getUserService = $getUserService;
        $this->uploadFileService = $uploadFileService;
        $this->createUserService = $createUserService;
        $this->updateUserService = $updateUserService;
        $this->deleteUserService = $deleteUserService;
        $this->changeLockAccountService = $changeLockAccountService;
    }

    public function index(Request $request)
    {
        $this->checkPermission('view_customer');
        $response = $this->getUserService->getUsersFilterByRole($request, $this->role);
        $data = [
            'rows'        => $response['data'],
            "page_title"  => __("Người dùng"),
            "breadcrumbs" => [
                [
                    "name"  => __("Người dùng"),
                    "class" => "active"
                ]
            ],
        ];
        return view("User::admin.customer.index", $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('create_customer');
        $data = [
            "page_title"  => __("Thêm người dùng"),
            "breadcrumbs" => [
                [
                    "name" => __("Thêm người dùng"),
                    "url"  => route("user.admin.customer.index")
                ],
                [
                    "name"  => __("Thêm người dùng"),
                    "class" => "active"
                ],
            ],
        ];
        return view("User::admin.customer.detail", $data);
    }

    public function update(Request $request, int $id)
    {
        $this->checkPermission('update_customer');
        if (!$id) abort(404);

        $response = $this->getUserService->getUserById($id);
        if (!$response['status']) abort(400);

        $row = $response['data'];

        $data = [
            "row"         => $row,
            "page_title"  => __("Cập nhật người dùng"),
            "breadcrumbs" => [
                [
                    "name" => __("Cập nhật người dùng"),
                    "url"  => route("user.admin.customer.index")
                ],
                [
                    "name"  => __("Cập nhật người dùng"),
                    "class" => "active"
                ],
            ],
        ];
        return view("User::admin.customer.detail", $data);
    }

    public function handleCreate(AdminRequest $request)
    {
        $this->checkPermission('create_customer');

        $data = [
            "avatar" => FileHelper::DEFAULT_AVATAR,
            ...($request->validated()),
            ...($this->getRequestOrRandomData($request)),
            'role' => $this->role
        ];

        $response = $this->createUserService->handle($data);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return redirect(route("user.admin.customer.index"))
            ->with("success", "Thêm thành công");
    }

    public function handleUpdate(AdminRequest $request, int $id)
    {
        $this->checkPermission('update_customer');

        if (!$id) abort(404);

        $data = [
            ...($request->validated()),
            ...($this->getRequestOrRandomData($request)),
        ];

        $response = $this->updateUserService->handle($data, $id);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return redirect(route("user.admin.customer.index"))
            ->with("success", "Cập nhật thành công");
    }

}
