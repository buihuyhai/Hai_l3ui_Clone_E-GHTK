<?php

namespace Modules\Shop\DTO\Response;

/**
 *
 */
class ShopResponse {
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string|null
     */
    private ?string $name;

    /**
     * @var string|null
     */
    private ?string $description;

    /**
     * @var string|null
     */
    private ?string $address;

    /**
     * @var string|null
     */
    private ?string $phone_number;

    /**
     * @var string|null
     */
    private ?string $email;

    /**
     * @var string|null
     */
    private ?string $logo_url;

    /**
     * @var bool|null
     */
    private ?bool $is_confirmed;

    /**
     * @var string|null
     */
    private ?string $status;


    /**
     * @var OwnerResponse|null
     */
    private ?OwnerResponse $ownerResponse;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @param int $id
     * @param string|null $name
     * @param string|null $description
     * @param string|null $address
     * @param string|null $phone
     * @param string|null $email
     * @param string|null $status
     * @param string|null $logo_url
     * @param OwnerResponse|null $ownerResponse
     * @return self
     */
    public static function withAllArguments(
        int $id,
        ?string $name,
        ?string $description,
        ?string $address,
        ?string $phone,
        ?string $email,
        ?string $status,
        ?string $logo_url,
        ?OwnerResponse $ownerResponse,
    ){
        $instance = new self();
        $instance->id = $id;
        $instance->name = $name;
        $instance->description = $description;
        $instance->address = $address;
        $instance->phone_number = $phone;
        $instance->email = $email;
        $instance->status = $status;
        $instance->logo_url = $logo_url;
        $instance->ownerResponse = $ownerResponse;
        return $instance;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'status' => $this->status,
            'logo_url' => $this->logo_url,
            'ownerResponse' => $this->ownerResponse?->toArray(),
        ];
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
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
        return $this->phone_number;
    }

    /**
     * @param string|null $phone_number
     * @return void
     */
    public function setPhoneNumber(?string $phone_number): void
    {
        $this->phone_number = $phone_number;
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
    public function getLogoUrl(): ?string
    {
        return $this->logo_url;
    }

    /**
     * @param string|null $logo_url
     * @return void
     */
    public function setLogoUrl(?string $logo_url): void
    {
        $this->logo_url = $logo_url;
    }

    /**
     * @return bool|null
     */
    public function getIsConfirmed(): ?bool
    {
        return $this->is_confirmed;
    }

    /**
     * @param bool|null $is_confirmed
     * @return void
     */
    public function setIsConfirmed(?bool $is_confirmed): void
    {
        $this->is_confirmed = $is_confirmed;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return void
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return OwnerResponse|null
     */
    public function getOwnerResponse(): ?OwnerResponse
    {
        return $this->ownerResponse;
    }

    /**
     * @param OwnerResponse|null $ownerResponse
     * @return void
     */
    public function setOwnerResponse(?OwnerResponse $ownerResponse): void
    {
        $this->ownerResponse = $ownerResponse;
    }


}
