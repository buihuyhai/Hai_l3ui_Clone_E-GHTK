<?php

namespace Modules\User\Services;

use Illuminate\Http\Request;

use Modules\Core\Services\BaseService;
use Modules\User\Models\User;


class GetUserService extends BaseService
{
    private int $limit; //Default limit user

    public function __construct()
    {
        $this->limit = config("response.pagination.limit") ?? 10;
    }

    //Get All User
    public function getAllUser(): array
    {
        return $this->responseData(true, User::all());
    }

    //Get Users Limit
    public function getUsersLimit(?int $limit): array
    {
        return $this->responseData(true,
            User::query()
                ->orderBy("updated_at", "desc")
                ->paginate($limit)
                ->withQueryString()
        );
    }

    //Get Users With Filter
    public function getUsersFilter(Request $request): array
    {
        $query = User::query()
            ->withoutRole('super_admin')
            ->orderBy("updated_at", "desc");

        if ($role = $request->role)
            $query->role($role);

        return $this->responseData(true,
            $query
                ->where($this->handleFilterRequest($request))
                ->paginate($request->limit ?? $this->limit)
                ->withQueryString()
        );
    }

    //Get Users By Role
    public function getUsersByRole(string $role = "", ?int $limit): array
    {
        $query = User::query()->orderBy("updated_at", "desc");

        if (!$role)
            return $this->responseData(false);

        $query->role($role);

        return $this->responseData(true,
            $query->paginate($limit ?? $this->limit)
        );
    }

    //Get Users Filter By Role
    public function getUsersFilterByRole(Request $request, string $role = ''): array
    {
        $query = User::query()->orderBy("updated_at", "desc");

        if (!$role)
            return $this->responseData(false);

        $query->role($role);

        return $this->responseData(true,
            $query
                ->where($this->handleFilterRequest($request))
                ->paginate($request->limit ?? $this->limit)
                ->withQueryString()
        );
    }

    //Get User By Id
    public function getUserById(int $id): array
    {
        $user = User::find($id);

        if (!$user)
            return $this->responseData(false);

        return $this->responseData(true, $user);
    }

    //Handle Filter Request
    public function handleFilterRequest(Request $request): array
    {
        $filters = [];

        if ($name = $request->name)
            $filters[] = ["name", "LIKE", "%$name%"];
        if ($email = $request->email)
            $filters[] = ["email", "LIKE", "%$email%"];
        if ($status = $request->status)
            $filters[] = ["status", "LIKE", $status];

        return $filters;
    }

}

