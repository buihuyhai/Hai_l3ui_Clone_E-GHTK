<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\Core\Services\BaseService;
use Modules\User\Models\User;
use Exception;
use Modules\User\Services\Cart\DeleteCartService;

class DeleteUserService extends BaseService
{
    protected DeleteCartService $deleteCartService;

    public function __construct(DeleteCartService $deleteCartService)
    {
        $this->deleteCartService = $deleteCartService;
    }

    public function handle(int $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $user = User::find($id);

                $this->deleteCartService->deleteCartByUserId($id);

                $user->delete();
            });
            return $this->responseData(true);
        } catch (Exception $e) {
            return $this->responseData(false);
        }

    }

}

