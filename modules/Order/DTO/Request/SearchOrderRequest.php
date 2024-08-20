<?php

namespace Modules\Order\DTO\Request;

/**
 *
 */
class SearchOrderRequest {

    /**
     * @var int|null
     */
    private ?int $status;
    /**
     * @var int|null
     */
    private ?int $pageSize = 15;

    /**
     * @param int|null $status
     * @param int|null $pageSize
     */
    public function __construct(?int $status, ?int $pageSize)
    {
        $this->status = $status;
        $this->pageSize = $pageSize;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }

    public function setPageSize(?int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }



}
