<?php

namespace Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BaseService
{
    public function responseData(
        string                                                   $status,
        array|Collection|JsonResource|LengthAwarePaginator|Model $data = []): array
    {
        return [
            'status' => $status,
            'data'   => $data,
        ];
    }
}
