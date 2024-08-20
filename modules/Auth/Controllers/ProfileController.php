<?php

namespace Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Modules\Auth\Requests\ProfileUpdateRequest;
use Modules\Media\Services\File\UploadFileService;
use Modules\User\Services\UpdateUserService;
use Modules\User\Traits\UserRequestTrait;

class ProfileController extends Controller
{
    use UserRequestTrait;

    protected UpdateUserService $updateUserService;

    public function __construct(
        UploadFileService $uploadFileService,
        UpdateUserService $updateUserService
    )
    {
        $this->updateUserService = $updateUserService;
        $this->uploadFileService = $uploadFileService;
    }

    public function index(Request $request): View
    {
        $data = [
            'row'         => $request->user(),
            "page_title"  => __("Thông tin cá nhân"),
            "breadcrumbs" => [
                [
                    "name"  => __("Thông tin cá nhân"),
                    "class" => "active"
                ]
            ],
        ];

        return view('Auth::personal.profile', $data);
    }

    public function handleUpdateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['name'] = $this->getFullName($request);

        if ($filePath = $this->getFilePath($request))
            $data["avatar"] = $filePath;

        $response = $this->updateUserService->handle($data, $request->user()->id);

        if (!$response['status'])
            return back()->with('error', "Đã có lỗi xảy ra!");

        return Redirect::route('profile.index')->with('success', 'Cập nhật thành công!');
    }
}
