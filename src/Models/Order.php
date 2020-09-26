<?php

namespace ShoptetFeed\Models;

use Carbon\Carbon;

class Order
{
    /** @var string */
    protected $code;
    /** @var Carbon */
    protected $date;
    /** @var string */
    protected $status;
    /** @var string|null */
    protected $packageNo;

    /** @var Item[] */
    protected $items = [];

    /**
     * Order constructor.
     * @param string $code
     * @param Carbon $date
     * @param string $status
     * @param string|null $packageNo
     */
    public function __construct(string $code, Carbon $date, string $status, ?string $packageNo = null)
    {
        $this->code = $code;
        $this->date = $date;
        $this->status = $status;
        $this->packageNo = $packageNo;
    }

    public function addItem(Item $item): void
    {
        $this->items[$item->getCode()] = $item;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getPackageNo(): string
    {
        return $this->packageNo;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}