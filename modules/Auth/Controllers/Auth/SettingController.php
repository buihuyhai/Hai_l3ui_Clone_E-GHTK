<?php

namespace Modules\Auth\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Requests\Auth\ChangePasswordRequest;
use Modules\Auth\Requests\Auth\DeleteAccountRequest;
use Modules\User\Services\DeleteUserService;
use Modules\User\Services\UpdateUserService;
use Modules\User\Traits\UserRequestTrait;

class SettingController extends Controller
{
    use UserRequestTrait;

    protected UpdateUserService $updateUserService;
    protected DeleteUserService $deleteUserService;

    public function __construct(
        UpdateUserService $updateUserService,
        DeleteUserService $deleteUserService
    )
    {
        $this->updateUserService = $updateUserService;
        $this->deleteUserService = $deleteUserService;
    }

    public function index(Request $request)
    {
        $data = [
            'row'         => $request->user(),
            "page_title"  => __("Cài đặt tài khoản"),
            "breadcrumbs" => [
                [
                    "name"  => __("Cài đặt tài khoản"),
                    "class" => "active"
                ]
            ],
        ];

        return view('Auth::personal.setting', $data);
    }

    public function handleChangePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $request->validated();

        $data['password'] = $this->getPassword($request);

        $response = $this->updateUserService->handle($data, $request->user()->id);

        if (!$response['status'])
            return back()->with('error', 'Đã có lỗi xảy ra!');

        return back()->with('success', 'Cập nhật mật khẩu thành công!');
    }

    public function handleDeleteAccount(DeleteAccountRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $id = Auth::id();

        Auth::logout();

        $response = $this->deleteUserService->handle($id);

        if (!$response['status'])
            return back()->with('error', 'Đã có lỗi xảy ra!');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }

}
