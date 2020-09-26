<?php

namespace ShoptetFeed\Models;

class Orders
{
    /** @var Order[] */
    protected $orders = [];

    public function addOrder(Order $order): void
    {
        $this->orders[$order->getCode()] = $order;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }
}