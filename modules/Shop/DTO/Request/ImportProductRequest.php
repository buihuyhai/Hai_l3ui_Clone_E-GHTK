<?php

namespace Modules\Shop\DTO\Request;

/**
 *
 */
class ImportProductRequest {

    /**
     * @var int|null
     */
    private ?int $number;
    /**
     * @var int|null
     */
    private ?int $productVariantId;
    /**
     * @var int|null
     */
    private ?int $type;

    /**
     * @param int $number
     * @param int $productVariantId
     * @param int $type
     */
    public function __construct(int $number, int $productVariantId, int $type){
        $this->number = $number;
        $this->productVariantId = $productVariantId;
        $this->type = $type;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     * @return void
     */
    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return int|null
     */
    public function getProductVariantId(): ?int
    {
        return $this->productVariantId;
    }

    /**
     * @param int|null $productVariantId
     * @return void
     */
    public function setProductVariantId(?int $productVariantId): void
    {
        $this->productVariantId = $productVariantId;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     * @return void
     */
    public function setType(?int $type): void
    {
        $this->type = $type;
    }




}
