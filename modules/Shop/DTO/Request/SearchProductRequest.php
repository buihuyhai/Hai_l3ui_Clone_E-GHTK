<?php

namespace Modules\Shop\DTO\Request;

/**
 *
 */
class SearchProductRequest {

    /**
     * @var String|null
     */
    private ?string $name;

    /**
     * @var int|null
     */
    private ?int $category;

    /**
     * @var int|null
     */
    private ?int $pageSize = 15;


    public function __construct(?string $name, ?int $category, ?int $pageSize = 15)
    {
        $this->name = $name;
        $this->category = $category;
        $this->pageSize = $pageSize;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return void
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getCategory(): ?int
    {
        return $this->category;
    }

    /**
     * @param int|null $category
     * @return void
     */
    public function setCategory(?int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return int|null
     */
    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }

    /**
     * @param int|null $pageSize
     * @return void
     */
    public function setPageSize(?int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }



    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
        ];
    }

}
