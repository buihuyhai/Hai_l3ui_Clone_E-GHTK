<?php

namespace Modules\User\Admin;

use Illuminate\Http\Request;
use Modules\Core\Admin\BaseController;
use Modules\User\Requests\Shop\UpdateShopRequest;
use Modules\User\Services\Shop\ConfirmShopService;
use Modules\User\Services\Shop\GetShopService;
use Modules\User\Services\Shop\UpdateShopService;
use Modules\Media\Services\File\UploadFileService;
use Modules\User\Services\Shop\ChangeStatusShopService;
use Modules\Shop\Enum\StatusShopEnum;
use Modules\User\Services\Shop\BulkActionShopService;

class ShopController extends BaseController
{
    protected ChangeStatusShopService $changeStatusShopService;
    protected BulkActionShopService $bulkActionShopService;
    protected ConfirmShopService $confirmShopService;
    protected UpdateShopService $updateShopService;
    protected UploadFileService $uploadFileService;
    protected GetShopService $getShopService;


    public function __construct(
        ChangeStatusShopService $changeStatusShopService,
        BulkActionShopService   $bulkActionShopService,
        ConfirmShopService      $confirmShopService,
        UploadFileService       $uploadFileService,
        UpdateShopService       $updateShopService,
        GetShopService          $getShopService
    )
    {
        $this->middleware(['can:manage_shop']);

        $this->changeStatusShopService = $changeStatusShopService;
        $this->bulkActionShopService = $bulkActionShopService;
        $this->confirmShopService = $confirmShopService;
        $this->uploadFileService = $uploadFileService;
        $this->updateShopService = $updateShopService;
        $this->getShopService = $getShopService;
    }

    public function index(Request $request)
    {
        $this->checkPermission("view_shop");
        $response = $this->getShopService->getShopsFilter($request);
        $data = [
            'rows'        => $response['data'],
            "page_title"  => __("Shop"),
            "breadcrumbs" => [
                [
                    "name"  => __("Shop"),
                    "class" => "active"
                ]
            ],
        ];
        return view("User::admin.shop.index", $data);
    }

    public function unconfrimed(Request $request)
    {
        $this->checkPermission("confirm_shop");
        $response = $this->getShopService->getShopsUnconfirmed($request);
        $data = [
            'rows'        => $response['data'],
            "page_title"  => __("Xác nhận Shop"),
            "breadcrumbs" => [
                [
                    "name" => __("Shop"),
                    "url"  => route("user.admin.shop.index")
                ],
                [
                    "name"  => __("Xác nhận Shop"),
                    "class" => "active"
                ]
            ],
        ];
        return view("User::admin.shop.unconfirmed", $data);
    }

    public function handleConfirm(Request $request, int $id)
    {
        $this->checkPermission("confirm_shop");
        if (!$id) abort(404);

        $response = $this->confirmShopService->handle($id);

        if (!$response['status']) return back()->with("error", "Đã có lỗi xảy ra!");

        return back()->with("success", $response['data']['message']);
    }

    public function update(Request $request, int $id)
    {
        $this->checkPermission("update_shop");

        if (!$id) abort(404);

        $response = $this->getShopService->getShopById($id);

        if (!$response['status']) abort(400);

        $data = [
            "row"         => $response['data'],
            "page_title"  => __("Cập nhật thông tin Shop"),
            "breadcrumbs" => [
                [
                    "name" => __("Shop"),
                    "url"  => route("user.admin.shop.index")
                ],
                [
                    "name"  => __("Cập nhật thông tin Shop"),
                    "class" => "active"
                ],
            ],
        ];
        return view("User::admin.shop.detail", $data);
    }

    public function handleUpdate(UpdateShopRequest $request, int $id)
    {
        $this->checkPermission("update_shop");

        if (!$id) abort(404);

        $data = $request->validated();

        if ($request->file('logo_url')) {
            $response = $this->uploadFileService->handle($request->file('logo_url'), 'Shop', 'Avatars');

            if ($response['status'])
                $data["logo_url"] = $response['data']['file_path'];
        }

        $response = $this->updateShopService->handle($data, $id);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return redirect(route("user.admin.shop.index"))
            ->with("success", "Cập nhật thành công");

    }

    public function handleLock(Request $request, int $id)
    {
        $this->checkPermission("lock_shop");
        if (!$id) abort(404);

        $response = $this->changeStatusShopService->handle($id, StatusShopEnum::STATUS_LOCKED);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra");

        return back()
            ->with("success", "Khóa thành công!");
    }

    public function handleBulkAction(Request $request)
    {
        $this->checkPermission("manage_shop");

        if (!$request->action) return back()->with("error", "Hành động không hợp lệ!");

        if (!$request->ids) return back()->with("error", "Dữ liệu không được để trống!");

        switch ($request->action) {
            case "lock":
            {
                $response = $this->bulkActionShopService->handleBulkStatus($request->ids, StatusShopEnum::STATUS_LOCKED);

                if (!$response['status'])
                    return back()->with("error", "Đã có lỗi xảy ra!");

                return back()->with("success", "Khóa thành công!");
            }
            case "open":
            {
                $response = $this->bulkActionShopService->handleBulkStatus($request->ids, StatusShopEnum::STATUS_OPEN);

                if (!$response['status'])
                    return back()->with("error", "Đã có lỗi xảy ra!");

                return back()->with("success", "Mở thành công!");
            }
            case "close":
            {
                $response = $this->bulkActionShopService->handleBulkStatus($request->ids, StatusShopEnum::STATUS_CLOSE);

                if (!$response['status'])
                    return back()->with("error", "Đã có lỗi xảy ra!");

                return back()->with("success", "Đóng thành công!");
            }
            case "confirm":
            {
                $response = $this->bulkActionShopService->handleBulkConfirm($request->ids);

                if (!$response['status'])
                    return back()->with("error", "Đã có lỗi xảy ra!");

                return back()->with("success", "Xác nhận thành công!");
            }
            default:
            {
                return back()->with("error", "Đã có lỗi xảy ra!");
            }
        }
    }

}


