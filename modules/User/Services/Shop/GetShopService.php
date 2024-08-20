<?php

namespace Modules\User\Services\Shop;

use Illuminate\Http\Request;
use Modules\Core\Services\BaseService;
use Modules\Shop\Enum\StatusShopEnum;
use Modules\Shop\Models\Shop;

class GetShopService extends BaseService
{
    private int $limit;

    public function __construct()
    {
        $this->limit = config("response.pagination.limit") ?? 10;
    }

    public function getAllShop(): array
    {
        return $this->responseData(true, Shop::all());
    }

    public function getShopsUnconfirmed(Request $request): array
    {
        $query = Shop::query()
            ->orderBy("updated_at", "desc")
            ->where('is_confirmed', "=", false);

        return $this->responseData(true,
            $query
                ->where($this->handleFilterRequest($request))
                ->paginate($request->limit ?? $this->limit)
                ->withQueryString()
        );
    }

    public function getShopsFilter(Request $request): array
    {
        $query = Shop::query()->orderBy("updated_at", "desc");

        return $this->responseData(
            true,
            $query
                ->where($this->handleFilterRequest($request))
                ->paginate($request->limit ?? $this->limit)
                ->withQueryString()
        );
    }

    public function getShopsLimit(int $limit): array
    {
        return $this->responseData(
            true,
            Shop::query()
                ->orderBy("updated_at", "desc")
                ->paginate($limit)
                ->withQueryString()
        );
    }

    public function getShopById(int $id): array
    {
        $shop = Shop::find($id);

        if (!$shop) return $this->responseData(false);

        return $this->responseData(true, $shop);
    }

    public function handleFilterRequest(Request $request): array
    {
        $filters = [];
        if ($name = $request->name)
            $filters[] = ["name", "LIKE", "%$name%"];
        if ($email = $request->email)
            $filters[] = ["email", "LIKE", "%$email%"];
        if ($status = $request->status) {
            switch ($status) {
                case "open":
                {
                    $filters[] = ["status", "=", StatusShopEnum::STATUS_OPEN];
                    break;
                }
                case "close":
                {
                    $filters[] = ["status", "=", StatusShopEnum::STATUS_CLOSE];
                    break;
                }
                case "locked":
                {
                    $filters[] = ["status", "=", StatusShopEnum::STATUS_LOCKED];
                    break;
                }
            }
        }
        if ($isConfirmed = $request->is_confirmed) {
            $filters[] = ["is_confirmed", "=", $isConfirmed == "true"];
        }

        return $filters;
    }


}
