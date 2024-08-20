<?php

namespace Modules\Core\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{

    public function checkPermission(string $permission = ''): void
    {
        if (!$permission or !Auth::check() or !Auth::user()->hasPermissionTo($permission)) {
            abort(403);
        }
    }


}
