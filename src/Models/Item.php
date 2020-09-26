<?php

namespace ShoptetFeed\Models;

class Item
{
    public const SHIPPING = 'shipping';
    public const BILLING = 'billing';
    /** @var string */
    protected $type;
    /** @var string */
    protected $code;
    /** @var int */
    protected $amount;
    /** @var string */
    protected $priceWoVat;

    /**
     * Item constructor.
     * @param string $type
     * @param string $code
     * @param int $amount
     * @param string $priceWoVat
     */
    public function __construct(string $type, string $code, int $amount, string $priceWoVat)
    {
        $this->type = $type;
        $this->code = $code;
        $this->amount = $amount;
        $this->priceWoVat = $priceWoVat;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getPriceWoVat(): string
    {
        return $this->priceWoVat;
    }

    public function isShipping(): bool
    {
        return $this->type === self::SHIPPING;
    }

    public function isBilling(): bool
    {
        return $this->type === self::BILLING;
    }
}