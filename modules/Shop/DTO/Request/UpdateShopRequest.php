<?php

namespace Modules\Shop\DTO\Request;

/**
 *
 */
class UpdateShopRequest {

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
     * @var string|null
     */
    private ?string $logo_url;

    /**
     * @var int
     */
    private int $updated_by;


    /**
     *
     */
    public function __construct()
    {
        $this->logo_url = null;
    }


    /**
     * @param int $name
     * @param string $description
     * @param string $address
     * @param string $phone
     * @param string $email
     * @param int $updated_by
     * @return self
     */
    public static function withAllArguments(
        int $name,
        string $description,
        string $address,
        string $phone,
        string $email,
        int $updated_by,
    ){
        $instance = new self();
        $instance->name = $name;
        $instance->description = $description;
        $instance->address = $address;
        $instance->phone_number = $phone;
        $instance->email = $email;
        $instance->updated_by = $updated_by;
        return $instance;
    }

    public function toArray()
    {
        $toArray = [
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'updated_by' => $this->updated_by,
        ];
        if ($this->logo_url !== null) {
            $toArray['logo_url'] = $this->logo_url;
        }
        return $toArray;
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


}
