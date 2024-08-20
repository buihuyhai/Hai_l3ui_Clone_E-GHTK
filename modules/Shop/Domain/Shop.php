<?php


namespace Modules\Shop\Domain;

/**
 *
 */
class Shop{
    /**
     * @var int
     */
    private int $id;
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
    private bool $is_confirmed;
    /**
     * @var string
     */
    private string $status;
    /**
     * @var OwnerShop
     */
    private OwnerShop $ownerShop;

    /**
     * @return OwnerShop
     */
    public function getOwnerShop(): OwnerShop
    {
        return $this->ownerShop;
    }

    /**
     * @param OwnerShop $ownerShop
     * @return void
     */
    public function setOwnerShop(OwnerShop $ownerShop): void
    {
        $this->ownerShop = $ownerShop;
    }


    /**
     *
     */
    public function __construct(){

    }

    /**
     * @param int $id
     * @param int $name
     * @param string $description
     * @param string $address
     * @param string $phone
     * @param string $email
     * @param bool $is_confirmed
     * @param string $status
     * @param OwnerShop $ownerShop
     * @return self
     */
    public static function withAllArgument(
        int $id,
        int $name,
        string $description,
        string $address,
        string $phone,
        string $email,
        bool $is_confirmed,
        string $status,
        OwnerShop $ownerShop
    ){
        $instance = new self();
        $instance->id = $id;
        $instance->name = $name;
        $instance->description = $description;
        $instance->address = $address;
        $instance->phone_number = $phone;
        $instance->email = $email;
        $instance->is_confirmed = $is_confirmed;
        $instance->status = $status;
        $instance->ownerShop = $ownerShop;
        return $instance;
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

    /**
     * @return bool
     */
    public function isIsConfirmed(): bool
    {
        return $this->is_confirmed;
    }

    /**
     * @param bool $is_confirmed
     * @return void
     */
    public function setIsConfirmed(bool $is_confirmed): void
    {
        $this->is_confirmed = $is_confirmed;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

}
