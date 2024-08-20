<?php
namespace Modules\Product\Services;

use Modules\Product\Models\Product;
use Modules\Product\Services\Contracts\SearchServiceInterface;

class SearchService implements SearchServiceInterface
{
    private ApplyOrderByService $applyOrderByService;
    private ApplyPriceRangeService $applyPriceRangeService;
    public function __construct(
        ApplyOrderByService $applyOrderByService,
        ApplyPriceRangeService $applyPriceRangeService
    ) {

        $this->applyOrderByService = $applyOrderByService;
        $this->applyPriceRangeService = $applyPriceRangeService;
    }
    public function search(array $data)
    {
        $keyword = $data['keyword'] ?? '';
        $orderby = $data['orderby'] ?? null;
        $minPrice = $data['minPrice'] ?? null;
        $maxPrice = $data['maxPrice'] ?? null;

        $query = Product::with('variants')
            ->where(function ($q) use ($keyword) {
                $q->where('name', 'like', $keyword . '%')
                    ->orWhere('name', 'LIKE', '% ' . $keyword . '%');
            });
        $this->applyOrderByService->handle($query, $orderby);
        $this->applyPriceRangeService->handle($query, $minPrice, $maxPrice);

        return $query->paginate(25);
    }
}