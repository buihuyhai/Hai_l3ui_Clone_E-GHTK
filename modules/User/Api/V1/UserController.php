<?php

namespace Modules\User\Api\V1;

use Illuminate\Http\Request;
use Modules\Auth\Hooks\RoleHook;
use Modules\Core\Api\BaseController;
use Modules\User\Models\User;
use Modules\User\Requests\UserRequest;
use Modules\User\Resources\UserCollection;
use Modules\User\Resources\UserResource;
use Modules\User\Services\CreateUserService;
use Modules\User\Services\DeleteUserService;
use Modules\User\Services\GetUserService;
use Modules\User\Services\UpdateUserService;

class UserController extends BaseController
{
    protected GetUserService $getUserService;
    protected CreateUserService $createUserService;
    protected UpdateUserService $updateUserService;
    protected DeleteUserService $deleteUserService;

    public function __construct(
        GetUserService    $getUserService,
        CreateUserService $createUserService,
        UpdateUserService $updateUserService,
        DeleteUserService $deleteUserService
    )
    {
        $this->getUserService = $getUserService;
        $this->createUserService = $createUserService;
        $this->updateUserService = $updateUserService;
        $this->deleteUserService = $deleteUserService;
    }

    public function index(Request $request)
    {
        $response = $this->getUserService->getUsersFilter($request);

        if (!$response['status'])
            return $this->responseBadRequest();

        return $this->responseSuccess(
            (new UserCollection($response['data'])),
            'Success'
        );
    }

    public function detail(Request $request, int $id)
    {
        if (!$id)
            return $this->responseNotFound();

        $response = $this->getUserService->getUserById($id);

        if (!$response['status'])
            return $this->responseNotFound();

        return $this->responseSuccess(
            new UserResource($response['data']),
            'Success',
        );
    }

    public function getAll(Request $request)
    {
        $response = $this->getUserService->getAllUser();

        if (!$response['status']) return $this->responseBadRequest();

        return $this->responseSuccess(
            new UserCollection($response['data']),
            'Success'
        );
    }

    public function getLimit(Request $request)
    {
        $response = $this->getUserService
            ->getUsersLimit($request->limit ?? config("response.pagination.limit"));

        if (!$response['status'])
            return $this->responseBadRequest();

        return $this->responseSuccess(
            new UserCollection($response['data']),
            'Success'
        );
    }

    public function getLimitVendor(Request $request)
    {
        $response = $this->getUserService
            ->getUsersByRole(RoleHook::VENDOR, $request->limit ?? config("response.pagination.limit"));

        if (!$response['status'])
            return $this->responseBadRequest();

        return $this->responseSuccess(
            $response['data'],
            'Success'
        );
    }

    public function getLimitCustomer(Request $request)
    {
        $response = $this->getUserService
            ->getUsersByRole(RoleHook::CUSTOMER, $request->limit ?? config("response.pagination.limit"));

        if (!$response['status'])
            return $this->responseBadRequest();

        return $this->responseSuccess(
            $response['data'],
            'Success'
        );
    }

    public function getLimitAdmin(Request $request)
    {
        $response = $this->getUserService
            ->getUsersByRole(RoleHook::ADMIN, $request->limit ?? config("response.pagination.limit"));

        if (!$response['status'])
            return $this->responseBadRequest();

        return $this->responseSuccess(
            $response['data'],
            'Success'
        );
    }

    public function create(UserRequest $request)
    {
        $response = $this->createUserService->handle($request->validated());

        if (!$response['status'])
            return $this->responseBadRequest($response['data']['message']);

        return $this->responseSuccess(
            new UserResource($response['data']),
            'Success'
        );
    }

    public function update(UserRequest $request, int $id)
    {
        if (!$id)
            return $this->responseNotFound();

        $response = $this->updateUserService->handle($request->validated(), $id);
        if (!$response['status'])
            return $this->responseBadRequest($response['data']['message']);

        return $this->responseSuccess(
            new UserResource($response['data']),
            'Success'
        );
    }

    public function delete(Request $request, int $id)
    {
        if (!$id) return $this->responseNotFound();

        $response = $this->deleteUserService->handle($id);

        if (!$response['status']) return $this->responseBadRequest($response['data']['message']);

        return $this->responseSuccess(true, 'Success');
    }

}
