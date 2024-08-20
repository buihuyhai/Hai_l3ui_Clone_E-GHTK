<?php

namespace Modules\Order\DTO\Request;

/**
 *
 */
class DetailOrderRequest {
    /**
     * @var int|null
     */
    private ?int $productVariantId;
    /**
     * @var int|null
     */
    private ?int $quantity;

    /**
     * @param int|null $productId
     * @param int|null $quantity
     */
    public function __construct(
        ?int $productVariantId,
        ?int $quantity,
    )
    {
        $this->productVariantId = $productVariantId;
        $this->quantity = $quantity;
    }

    public function getProductVariantId(): ?int
    {
        return $this->productVariantId;
    }

    public function setProductVariantId(?int $productVariantId): void
    {
        $this->productVariantId = $productVariantId;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }


}
