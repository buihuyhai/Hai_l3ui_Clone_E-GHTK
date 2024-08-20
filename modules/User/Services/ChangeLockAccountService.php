<?php

namespace Modules\User\Services;

use Modules\Core\Services\BaseService;
use Modules\User\Hooks\StatusHook;
use Modules\User\Models\User;

class ChangeLockAccountService extends BaseService
{
    public function __construct()
    {
    }

    //Handle Change Lock Account
    public function handle(int $id)
    {
        $user = User::find($id);
        $data = [];
        if (!$user)
            return $this->responseData(false);

        if ($user->isLocked()) {
            $user->status = StatusHook::ACTIVE;
            $data['message'] = "Mở khóa tài khoản thành công!";
        } else {
            $user->status = StatusHook::BANNED;
            $data['message'] = "Khóa tài khoản thành công!";
        }

        return $this->responseData($user->save(), $data);
    }


}

