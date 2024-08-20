<?php

namespace Modules\Order\Domain;

class OrderDetail
{
    /**
     * @var int|null
     */
    private ?int $id;
    /**
     * @var int|null
     */
    private ?int $quantity;
    /**
     * @var int|null
     */
    private ?int $salePrice;
    /**
     * @var int|null
     */
    private ?int $importPrice;

    /**
     * @var int|null
     */
    private ?int $variantId;

    /**
     * @var Order|null
     */
    private ?Order $order;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     * @return void
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int|null
     */
    public function getSalePrice(): ?int
    {
        return $this->salePrice;
    }

    /**
     * @param int|null $salePrice
     * @return void
     */
    public function setSalePrice(?int $salePrice): void
    {
        $this->salePrice = $salePrice;
    }

    /**
     * @return int|null
     */
    public function getImportPrice(): ?int
    {
        return $this->importPrice;
    }

    /**
     * @param int|null $importPrice
     * @return void
     */
    public function setImportPrice(?int $importPrice): void
    {
        $this->importPrice = $importPrice;
    }

    /**
     * @return int|null
     */
    public function getVariantId(): ?int
    {
        return $this->variantId;
    }

    /**
     * @param int|null $variantId
     * @return void
     */
    public function setVariantId(?int $variantId): void
    {
        $this->variantId = $variantId;
    }

    /**
     * @return Order|null
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @param Order|null $order
     * @return void
     */
    public function setOrder(?Order $order): void
    {
        $this->order = $order;
    }


}
