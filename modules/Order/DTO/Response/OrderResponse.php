<?php

namespace Modules\Order\DTO\Response;

class OrderResponse
{
    private ?int $id;
    private ?string $customerName;


    private ?int $discount;
    private ?int $finalCost;
    private ?string $email;

    private ?string $address;
    private ?string $phoneNumber;
    private ?string $status;
    private ?int $statusCode;

    private ?array $detail;

    /**
     * @param int|null $id
     * @param string|null $customerName
     * @param int|null $discount
     * @param int|null $finalCost
     * @param string|null $email
     * @param string|null $address
     * @param string|null $phoneNumber
     * @param string|null $status
     * @param int|null $statusCode
     * @param array|null $detail
     */
    public function __construct(?int $id = null, ?string $customerName = null, ?int $discount = null, ?int $finalCost = null, ?string $email = null, ?string $address = null, ?string $phoneNumber = null, ?string $status = null, ?int $statusCode = null, ?array $detail = [])
    {
        $this->id = $id;
        $this->customerName = $customerName;
        $this->discount = $discount;
        $this->finalCost = $finalCost;
        $this->email = $email;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->status = $status;
        $this->statusCode = $statusCode;
        $this->detail = $detail;
    }

    public function getDetail(): ?array
    {
        return $this->detail;
    }

    public function setDetail(?array $detail): void
    {
        $this->detail = $detail;
    }


    /**
     */



    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'customer' => $this->customerName,
            'discount' => $this->discount,
            'finalCost' => $this->finalCost,
            'email' => $this->email,
            'address' => $this->address,
            'phone_number' => $this->phoneNumber,
            'status' => $this->status,
            'statusCode' => $this->statusCode,
            'detail' => $this->detail
        ];
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(?string $customerName): void
    {
        $this->customerName = $customerName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): void
    {
        $this->discount = $discount;
    }

    public function getFinalCost(): ?int
    {
        return $this->finalCost;
    }

    public function setFinalCost(?int $finalCost): void
    {
        $this->finalCost = $finalCost;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function setStatusCode(?int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }


}
