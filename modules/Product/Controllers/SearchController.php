<?php
namespace Modules\Product\Controllers;
use Modules\Product\Requests\SearchRequest;
use Modules\Product\Services\SearchService;

class SearchController
{
    private $searchService;
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }
    public function search(SearchRequest $request)
    {
        $products = $this->searchService->search($request->validated());
        if($request->ajax()) {
            return view('Product::frontend.components.product.list', compact('products'));
        }
        return view('Product::frontend.search', compact('products'));
    }
}