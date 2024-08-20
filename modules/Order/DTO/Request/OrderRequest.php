<?php

namespace Modules\Order\DTO\Request;

/**
 *
 */
class OrderRequest {
    /**
     * @var string|null
     */
    private ?string $email;
    /**
     * @var string|null
     */
    private ?string $address;
    /**
     * @var string|null
     */
    private ?string $phoneNumber;
    /**
     * @var string|null
     */
    private ?string $description;
    /**
     * @var array|null
     */
    private ?array $coupons;
    /**
     * @var array|null
     */
    private ?array $detail;

    /**
     * @var array|null
     */
    private ?array $carts;

    /**
     * @return array|null
     */
    public function getDetail(): ?array
    {
        return $this->detail;
    }

    /**
     * @param array|null $detail
     * @return void
     */
    public function setDetail(?array $detail): void
    {
        $this->detail = $detail;
    }


    /**
     * @param string|null $email
     * @param string|null $address
     * @param string|null $phoneNumber
     * @param string|null $description
     * @param array|null $coupons
     * @param array|null $detail
     * @param array|null $carts
     */
    public function __construct(?string $email, ?string $address, ?string $phoneNumber, ?string $description, ?array $coupons,?array $detail
        , ?array $carts = []
    )
    {
        $this->email = $email;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->description = $description;
        $this->coupons = $coupons;
        $this->detail = $detail;
        $this->carts = $carts;
    }

    /**
     * @return array|null
     */
    public function getCarts(): ?array
    {
        return $this->carts;
    }

    /**
     * @param array|null $carts
     * @return void
     */
    public function setCarts(?array $carts): void
    {
        $this->carts = $carts;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return void
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return void
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return void
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
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
    public function getCoupons(): ?array
    {
        return $this->coupons;
    }

    /**
     * @param array|null $coupons
     * @return void
     */
    public function setCoupons(?array $coupons): void
    {
        $this->coupons = $coupons;
    }

}
