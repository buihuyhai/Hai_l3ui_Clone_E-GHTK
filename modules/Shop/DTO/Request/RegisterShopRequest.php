<?php

namespace Modules\Shop\DTO\Request;

/**
 *
 */
class RegisterShopRequest {
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var string
     */
    private string $address;
    /**
     * @var string
     */
    private string $phone_number;
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $logo_url;
    /**
     * @var bool
     */
    private ?bool $is_confirmed;

    /**
     * @var string|null
     */
    private ?string $status;


    /**
     * @var int|null
     */
    private ?int $owner;

    /**
     * @var int|null
     */
    private ?int $created_by;
    /**
     * @var int|null
     */
    private ?int $updated_by;

    /**
     *
     */
    public function __construct()
    {
        $this->owner = null;
    }

    /**
     * @return int|null
     */
    public function getOwner(): ?int
    {
        return $this->owner;
    }

    /**
     * @param int|null $owner
     * @return void
     */
    public function setOwner(?int $owner): void
    {
        $this->owner = $owner;
    }




    /**
     * @param int $name
     * @param string $description
     * @param string $address
     * @param string $phone
     * @param string $email
     * @param bool $is_confirmed
     * @param string $status
     * @param int $owner
     * @param string $logo_url
     * @param int $created_by
     * @param int $updated_by
     * @return self
     */
    public static function withAllArguments(
        int $name,
        string $description,
        string $address,
        string $phone,
        string $email,
        bool $is_confirmed,
        string $status,
        int $owner,
        string $logo_url,
        int $created_by,
        int $updated_by
    ){
        $instance = new self();
        $instance->name = $name;
        $instance->description = $description;
        $instance->address = $address;
        $instance->phone_number = $phone;
        $instance->email = $email;
        $instance->is_confirmed = $is_confirmed;
        $instance->status = $status;
        $instance->owner = $owner;
        $instance->logo_url = $logo_url;
        $instance->created_by = $created_by;
        $instance->updated_by = $updated_by;
        return $instance;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return void
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->created_by;
    }

    /**
     * @param int $created_by
     * @return void
     */
    public function setCreatedBy(int $created_by): void
    {
        $this->created_by = $created_by;
    }

    /**
     * @return int
     */
    public function getUpdatedBy(): int
    {
        return $this->updated_by;
    }

    /**
     * @param int $updated_by
     * @return void
     */
    public function setUpdatedBy(int $updated_by): void
    {
        $this->updated_by = $updated_by;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * @param string $phone_number
     * @return void
     */
    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLogoUrl(): string
    {
        return $this->logo_url;
    }

    /**
     * @param string $logo_url
     * @return void
     */
    public function setLogoUrl(string $logo_url): void
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
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'logo_url'  => $this->logo_url,
            'is_confirmed' => $this->is_confirmed,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }

}
