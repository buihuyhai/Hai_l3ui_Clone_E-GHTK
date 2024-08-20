<?php

namespace Modules\Auth\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Modules\Auth\Requests\Auth\RegisterUserRequest;
use Modules\Auth\Hooks\RoleHook;
use Modules\Media\Helpers\FileHelper;
use Modules\User\Services\Cart\CreateCartService;
use Modules\User\Services\CreateUserService;
use Modules\User\Traits\UserRequestTrait;

class RegisteredUserController extends Controller
{
    use UserRequestTrait;

    protected CreateCartService $createCartService;
    protected CreateUserService $createUserService;

    public function __construct(
        CreateCartService $createCartService,
        CreateUserService $createUserService
    )
    {
        $this->createCartService = $createCartService;
        $this->createUserService = $createUserService;
    }

    public function index(): View
    {
        return view('Auth::auth.register');
    }

    public function handleRegister(RegisterUserRequest $request): RedirectResponse
    {
        $data = [
            ...($request->validated()),
            ...($this->getRequestOrRandomData($request)),
            'role'   => RoleHook::CUSTOMER,
            'avatar' => FileHelper::DEFAULT_AVATAR,
        ];

        $response = $this->createUserService->handle($data);

        if (!$response['status'])
            return back()->with("error", "Đã có lỗi xảy ra!");

        $user = $response['data'];

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home.index', absolute: false));
    }
}
