<?php
namespace Modules\Product\Services\Contracts;

interface UserOrderInterface
{
    public function getUserOrder(int $userId, string $type);
}