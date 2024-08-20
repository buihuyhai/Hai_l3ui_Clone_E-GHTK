<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\Auth\Hooks\RoleHook;
use Modules\Core\Services\BaseService;
use Modules\User\Models\User;
use Exception;
use Modules\User\Services\Cart\CreateCartService;

class CreateUserService extends BaseService
{
    protected CreateCartService $createCartService;

    public function __construct(CreateCartService $createCartService)
    {
        $this->createCartService = $createCartService;
    }

    //Handle Create User
    public function handle(array $data)
    {
        $user = null;
        try {
            DB::transaction(function () use ($data, &$user) {
                $user = User::create($data);

                $user->assignRole($data['role']);

                if ($user->hasRole(RoleHook::CUSTOMER)) {
                    $this->createCartService->handle([
                        "user_id" => $user->id,
                    ]);
                }
            });
            return $this->responseData(true, $user);
        } catch (Exception $e) {
            return $this->responseData(false);
        }
    }


}

