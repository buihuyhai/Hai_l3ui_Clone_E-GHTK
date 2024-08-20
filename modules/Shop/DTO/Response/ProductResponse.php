<?php

namespace Modules\Shop\DTO\Response;

/**
 *
 */
class ProductResponse {
    /**
     * @var int|null
     */
    private ?int $id;
    /**
     * @var string|null
     */
    private ?string $name;
    /**
     * @var float|null
     */
    private ?float $price;
    /**
     * @var float|null
     */
    private ?float $salePrice;
    /**
     * @var string|null
     */
    private ?string $shortDesc;
    /**
     * @var string|null
     */
    private ?string $description;
    /**
     * @var int|null
     */
    private ?int $sold;
    /**
     * @var string|null
     */
    private ?string $slug;
    /**
     * @var string|null
     */
    private ?string $thumbnail;
    /**
     * @var string|null
     */
    private ?string $categoryName;
    /**
     * @var int|null
     */
    private ?int $categoryId;
    /**
     * @var int|null
     */
    private ?int $userCreated;
    /**
     * @var int|null
     */
    private ?int $userUpdated;
    /**
     * @var array|null
     */
    private ?array $variants;

    /**
     *
     */
    public function __construct()
    {
        $this->id = null;
        $this->name = null;
        $this->price = null;
        $this->salePrice = null;
        $this->shortDesc = null;
        $this->description = null;
        $this->slug = null;
        $this->sold = null;
        $this->thumbnail = null;
        $this->categoryName = null;
        $this->categoryId = null;
        $this->userCreated = null;
        $this->userUpdated = null;
        $this->variants = null;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'sale_price' => $this->salePrice,
            'short_desc' => $this->shortDesc,
            'description' => $this->description,
            'slug' => $this->slug,
            'sold' => $this->sold,
            'thumbnail' => $this->thumbnail,
            'category_name' => $this->categoryName,
            'category_id' => $this->categoryId,
            'user_created' => $this->userCreated,
            'user_updated' => $this->userUpdated,
            'variants' => $this->variants,
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
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return void
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float|null
     */
    public function getSalePrice(): ?float
    {
        return $this->salePrice;
    }

    /**
     * @param float|null $salePrice
     * @return void
     */
    public function setSalePrice(?float $salePrice): void
    {
        $this->salePrice = $salePrice;
    }

    /**
     * @return string|null
     */
    public function getShortDesc(): ?string
    {
        return $this->shortDesc;
    }

    /**
     * @param string|null $shortDesc
     * @return void
     */
    public function setShortDesc(?string $shortDesc): void
    {
        $this->shortDesc = $shortDesc;
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
     * @return int|null
     */
    public function getSold(): ?int
    {
        return $this->sold;
    }

    /**
     * @param int|null $sold
     * @return void
     */
    public function setSold(?int $sold): void
    {
        $this->sold = $sold;
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
     * @return string|null
     */
    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    /**
     * @param string|null $categoryName
     * @return void
     */
    public function setCategoryName(?string $categoryName): void
    {
        $this->categoryName = $categoryName;
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
     * @return int|null
     */
    public function getUserCreated(): ?int
    {
        return $this->userCreated;
    }

    /**
     * @param int|null $userCreated
     * @return void
     */
    public function setUserCreated(?int $userCreated): void
    {
        $this->userCreated = $userCreated;
    }

    /**
     * @return int|null
     */
    public function getUserUpdated(): ?int
    {
        return $this->userUpdated;
    }

    /**
     * @param int|null $userUpdated
     * @return void
     */
    public function setUserUpdated(?int $userUpdated): void
    {
        $this->userUpdated = $userUpdated;
    }

    /**
     * @return array|null
     */
    public function getVariants(): ?array
    {
        return $this->variants;
    }

    /**
     * @param array|null $variants
     * @return void
     */
    public function setVariants(?array $variants): void
    {
        $this->variants = $variants;
    }




}
