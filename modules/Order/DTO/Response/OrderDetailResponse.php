<?php

namespace Modules\Order\DTO\Response;

class OrderDetailResponse
{
    /**
     * @var int|null
     */
    private ?int $id;
    /**
     * @var string|null
     */
    private ?string $productName;
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
     * @var string|null
     */
    private ?string $image;

    /**
     * @param int|null $id
     * @param string|null $productName
     * @param int|null $quantity
     * @param int|null $salePrice
     * @param int|null $importPrice
     * @param string|null $image
     */
    public function __construct(?int $id, ?string $productName, ?int $quantity, ?int $salePrice, ?int $importPrice, ?string $image)
    {
        $this->id = $id;
        $this->productName = $productName;
        $this->quantity = $quantity;
        $this->salePrice = $salePrice;
        $this->importPrice = $importPrice;
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return void
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'product_name' => $this->productName,
            'quantity' => $this->quantity,
            'sale_price' => $this->salePrice,
            'import_price' => $this->importPrice
        ];
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
     * @return string|null
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @param string|null $productName
     * @return void
     */
    public function setProductName(?string $productName): void
    {
        $this->productName = $productName;
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




}
