<?php

namespace Modules\Shop\Domain;

/**
 *
 */
class OwnerShop {
    /**
     * @var int
     */
    private int $id;
    /**
     * @var User
     */
    private User $owner;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @param int $id
     * @param User $owner
     * @return OwnerShop
     */
    public static function withAllArguments(int $id, User $owner)
    {
        $instance = new OwnerShop();
        $instance->id = $id;
        $instance->owner = $owner;
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
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return void
     */
    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }

}

