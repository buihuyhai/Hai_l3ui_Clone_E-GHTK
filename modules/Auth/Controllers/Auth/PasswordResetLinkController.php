<?php

namespace Modules\Auth\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Modules\Auth\Requests\Auth\PasswordResetLinkRequest;

class PasswordResetLinkController extends Controller
{
    public function index(): View
    {
        return view('Auth::auth.forgot-password');
    }

    public function handlePasswordResetLink(PasswordResetLinkRequest $request): RedirectResponse
    {
        $request->validated();

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
