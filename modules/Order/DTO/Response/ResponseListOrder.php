<?php

namespace Modules\Order\DTO\Response;

class ResponseListOrder
{
    /**
     * @var array
     */
    private array $orders;
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
     * @param array $orders
     * @param int $total
     * @param int $currentPage
     * @param int $lastPage
     * @param int $prePage
     * @param array|null $paginate
     */
    public function __construct(array $orders, int $total, int $currentPage, int $lastPage, int $prePage, ?array $paginate)
    {
        $this->orders = $orders;
        $this->total = $total;
        $this->currentPage = $currentPage;
        $this->lastPage = $lastPage;
        $this->prePage = $prePage;
        $this->paginate = $paginate;
    }

    public function getOrders(): array
    {
        return $this->orders;
    }

    public function setOrders(array $orders): void
    {
        $this->orders = $orders;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

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

    public function getPrePage(): int
    {
        return $this->prePage;
    }

    public function setPrePage(int $prePage): void
    {
        $this->prePage = $prePage;
    }

    public function getPaginate(): ?array
    {
        return $this->paginate;
    }

    public function setPaginate(?array $paginate): void
    {
        $this->paginate = $paginate;
    }

    public function toArray(): array
    {
        return [
            'orders' => $this->orders,
            'total' => $this->total,
            'current_page' => $this->currentPage,
            'last_page' => $this->lastPage,
            'pre_page' => $this->prePage,
            'paginate' => $this->paginate,
        ];
    }


}
