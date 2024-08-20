<?php

namespace Modules\Shop\DTO\Response;

use Modules\Shop\Models\Product;

class ResponseListProduct
{
    /**
     * @var array
     */
    private array $products;
    /**
     * @var int
     */
    private int $total;
    /**
     * @var int
     */
    private int $currentPage;
    /**
     * @var int
     */
    private int $lastPage;
    /**
     * @var int
     */
    private int $prePage;
    /**
     * @var array|null
     */
    private ?array $paginate;

    /**
     * @param array $products
     * @param int $total
     * @param int $currentPage
     * @param int $lastPage
     * @param int $prePage
     * @param array|null $paginate
     */
    public function __construct(array $products, int $total, int $currentPage, int $lastPage, int $prePage, ?array $paginate){
        $this->products = $products;
        $this->total = $total;
        $this->currentPage = $currentPage;
        $this->lastPage = $lastPage;
        $this->prePage = $prePage;
        $this->paginate = $paginate;
    }

    public function toArray(): array
    {
        return [
            'products' => $this->products,
            'total' => $this->total,
            'current_page' => $this->currentPage,
            'last_page' => $this->lastPage,
            'pre_page' => $this->prePage,
            'paginate' => $this->paginate,
        ];
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     * @return void
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return void
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     * @return void
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    public function setLastPage(int $lastPage): void
    {
        $this->lastPage = $lastPage;
    }




    /**
     * @return int
     */
    public function getPrePage(): int
    {
        return $this->prePage;
    }

    /**
     * @param int $prePage
     * @return void
     */
    public function setPrePage(int $prePage): void
    {
        $this->prePage = $prePage;
    }

    /**
     * @return array|null
     */
    public function getPaginate(): ?array
    {
        return $this->paginate;
    }

    /**
     * @param array|null $paginate
     * @return void
     */
    public function setPaginate(?array $paginate): void
    {
        $this->paginate = $paginate;
    }



}
