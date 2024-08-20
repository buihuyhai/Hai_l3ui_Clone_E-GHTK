<?php

namespace Modules\Shop\DTO\Response;

class OwnerResponse {
    /**
     * @var int
     */
    private int $id;


    /**
     * @var string|null
     */
    private ?string $firstName;

    /**
     * @var string|null
     */
    private ?string $lastName;

    /**
     * @var string|null
     */
    private ?string $name;


    /**
     * @var string|null
     */
    private ?string $phone;

    /**
     *
     */
    public function __construct() {

    }

    /**
     * @param int $id
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $name
     * @param string|null $phoneNumber
     * @return self
     */
    public static function withAllArguments(
        int $id,
        ?string $firstName,
        ?string $lastName,
        ?string $name,
        ?string $phoneNumber
    )
    {
        $instance = new self();
        $instance->id = $id;
        $instance->lastName = $lastName;
        $instance->firstName = $firstName;
        $instance->name = $name;
        $instance->phone = $phoneNumber;
        return $instance;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'name' => $this->name,
            'phone' => $this->phone,
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
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     * @return void
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return void
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
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
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return void
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }




}
