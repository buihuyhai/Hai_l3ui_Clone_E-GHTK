<?php

namespace Modules\Order\DTO\Request;

/**
 *
 */
class CouponRequest {
    /**
     * @var int|null
     */
    private ?int $shopId;
    /**
     * @var int|null
     */
    private ?int $couponId;

    /**
     * @param int|null $shopId
     * @param int|null $couponId
     */
    public function __construct(
        ?int $shopId,
        ?int $couponId,
    )
    {
        $this->shopId = $shopId;
        $this->couponId = $couponId;
    }

    /**
     * @return int|null
     */
    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    /**
     * @param int|null $shopId
     * @return void
     */
    public function setShopId(?int $shopId): void
    {
        $this->shopId = $shopId;
    }

    /**
     * @return int|null
     */
    public function getCouponId(): ?int
    {
        return $this->couponId;
    }

    /**
     * @param int|null $couponId
     * @return void
     */
    public function setCouponId(?int $couponId): void
    {
        $this->couponId = $couponId;
    }




}
