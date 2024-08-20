<?php

namespace Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\User\Services\Cart\DeleteCartService;
use Modules\User\Services\ChangeRoleService;
use Modules\Auth\Hooks\RoleHook;

class VendorController
{

    protected ChangeRoleService $changeRoleService;
    protected DeleteCartService $deleteCartService;

    public function __construct(ChangeRoleService $changeRoleService, DeleteCartService $deleteCartService)
    {
        $this->changeRoleService = $changeRoleService;
        $this->deleteCartService = $deleteCartService;
    }

    public function index(Request $request, int $id)
    {
    }

    public function activeNow()
    {
        if (Auth::user()->hasRole(RoleHook::VENDOR))

            return redirect()->route('vendor.register');

        return view("User::frontend.vendor.active");
    }

    public function handleActive(Request $request)
    {
        $response = $this->changeRoleService->handle(RoleHook::VENDOR, Auth::id());

        if (!$response['status'])
            return back()->with('error', 'Đã có lỗi xảy ra!');

        $this->deleteCartService->deleteCartByUserId(Auth::id());

        return redirect()->route('vendor.register');
    }

    public function register(Request $request)
    {
        $data = [
            "row" => Auth::user(),
        ];
        return view("User::frontend.vendor.register", $data);
    }

}

