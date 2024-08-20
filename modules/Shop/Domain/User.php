<?php

namespace Modules\Shop\Domain;

class User {
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $lastName;
    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $password;
    /**
     * @var string
     */
    private string $phone;

    /**
     *
     */
    public function __construct() {

    }

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $name
     * @param string $password
     * @param string $phoneNumber
     * @return self
     */
    public static function withAllArguments(int $id, string $firstName, string $lastName, string $name, string $password, string $phoneNumber)
    {
        $instance = new self();
        $instance->id = $id;
        $instance->firstName = $firstName;
        $instance->lastName = $lastName;
        $instance->name = $name;
        $instance->password = $password;
        $instance->phone = $phoneNumber;
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return void
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return void
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return void
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }


}
