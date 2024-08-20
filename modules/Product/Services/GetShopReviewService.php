<?php
namespace Modules\Product\Services;
use Modules\Shop\Service\Shop\GetShopService;

class GetShopReviewService
{
    private $getShopService;

    public function __construct(GetShopService $getShopService)
    {
        $this->getShopService = $getShopService;
    }
    public function handle(?int $id)
    {
        $shop = $this->getShopService->handle($id);
    }
}