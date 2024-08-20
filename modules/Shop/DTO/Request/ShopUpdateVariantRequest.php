<?php

namespace Modules\Shop\DTO\Request;

class ShopUpdateVariantRequest
{
    /**
     * @var int|null
     */
    private ?int $id;
    /**
     * @var string|null
     */
    private ?string $name;
    /**
     * @var int|null
     */
    private ?int $price;
    /**
     * @var int|null
     */
    private ?int $salePrice;
    /**
     * @var int|null
     */
    private ?int $importPrice;

    /**
     * @param int|null $id
     * @param string|null $name
     * @param int|null $price
     * @param int|null $salePrice
     * @param int|null $importPrice
     */
    public function __construct(?int $id, ?string $name, ?int $price, ?int $salePrice, ?int $importPrice)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->salePrice = $salePrice;
        $this->importPrice = $importPrice;
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
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     * @return void
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
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
