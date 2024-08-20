<?php

namespace Modules\Auth\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Auth\Requests\Auth\LoginRequest;
use Modules\User\Services\UpdateLastLoginAtService;

class LoginController extends Controller
{
    protected UpdateLastLoginAtService $updateLastLoginAtService;

    public function __construct(UpdateLastLoginAtService $updateLastLoginAtService)
    {
        $this->updateLastLoginAtService = $updateLastLoginAtService;
    }

    public function index(): View
    {
        return view('Auth::auth.login');
    }

    public function handleLogin(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $this->updateLastLoginAtService->handle(Auth::id());

        return redirect()->intended(route('home.index', absolute: false));
    }

    public function handleLogout(Request $request): RedirectResponse
    {
        $response = $this->updateLastLoginAtService->handle(Auth::id());

        if (!$response['status']) return back()->with("error", "Đã có lỗi xảy ra");

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }
}
