<?php

namespace Modules\Shop\DTO\Response;

/**
 *
 */
class UpdateShopResponse {
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @param int $id
     * @param string $name
     * @return self
     */
    public static function withAllArguments(int $id, string $name){
        $instance = new self();
        $instance->id = $id;
        $instance->name = $name;
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




}
