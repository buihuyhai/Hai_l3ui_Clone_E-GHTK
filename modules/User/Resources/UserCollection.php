<?php

namespace Modules\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Core\Resources\PaginationResource;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $resource = UserResource::class;

    public function toArray(Request $request): array
    {
        return [
            "data"       => $this->collection,
            "pagination" => new PaginationResource($this),
        ];
    }
}
