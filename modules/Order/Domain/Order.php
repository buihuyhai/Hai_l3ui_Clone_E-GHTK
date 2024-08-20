<?php

namespace Modules\Order\Domain;

class Order
{
    /**
     * @var int|null
     */
    private ?int $id;
    /**
     * @var int|null
     */
    private ?int $customerId;
    /**
     * @var int|null
     */
    private ?int $shopId;
    /**
     * @var string|null
     */
    private ?string $discount;
    /**
     * @var string|null
     */
    private ?string $finalCost;
    /**
     * @var int|null
     */
    private ?int $status;
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
    private ?array $orderDetails;

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
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     * @return void
     */
    public function setCustomerId(?int $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int|null
     */
    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    /**
     * @param int|null $shopId
     * @return void
     */
    public function setShopId(?int $shopId): void
    {
        $this->shopId = $shopId;
    }

    /**
     * @return string|null
     */
    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    /**
     * @param string|null $discount
     * @return void
     */
    public function setDiscount(?string $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return string|null
     */
    public function getFinalCost(): ?string
    {
        return $this->finalCost;
    }

    /**
     * @param string|null $finalCost
     * @return void
     */
    public function setFinalCost(?string $finalCost): void
    {
        $this->finalCost = $finalCost;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     * @return void
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
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
    public function getOrderDetails(): ?array
    {
        return $this->orderDetails;
    }

    /**
     * @param array|null $orderDetails
     * @return void
     */
    public function setOrderDetails(?array $orderDetails): void
    {
        $this->orderDetails = $orderDetails;
    }

}
