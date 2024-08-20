<?php
namespace Modules\Shop\DTO\Request;

class ShopCreateProductRequest
{
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
     * @var string|null
     */
    private ?string $slug;
    /**
     * @var string|null
     */
    private ?string $thumbnail;
    /**
     * @var int|null
     */
    private ?int $categoryId;
    /**
     * @var string|null
     */
    private ?string $description;
    /**
     * @var array|null
     */
    private ?array $variant;

    /**
     * @param string|null $name
     * @param int|null $price
     * @param int|null $salePrice
     * @param string|null $slug
     * @param string|null $thumbnail
     * @param int|null $categoryId
     * @param string|null $description
     * @param array|null $variant
     */
    public function __construct(?string $name, ?int $price, ?int $salePrice, ?string $slug, ?string $thumbnail, ?int $categoryId, ?string $description, ?array $variant)
    {
        $this->name = $name;
        $this->price = $price;
        $this->salePrice = $salePrice;
        $this->slug = $slug;
        $this->thumbnail = $thumbnail;
        $this->categoryId = $categoryId;
        $this->description = $description;
        $this->variant = $variant;
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
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return void
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param string|null $thumbnail
     * @return void
     */
    public function setThumbnail(?string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     * @return void
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


    /**
     * @return array|null
     */
    public function getVariant(): ?array
    {
        return $this->variant;
    }

    /**
     * @param array|null $variant
     * @return void
     */
    public function setVariant(?array $variant): void
    {
        $this->variant = $variant;
    }


}
