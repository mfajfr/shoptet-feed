<?php

namespace ShoptetFeed;

use Carbon\Carbon;
use ShoptetFeed\Models\Item;
use ShoptetFeed\Models\Order;
use ShoptetFeed\Models\Orders;

class Reader
{
    /**
     * @var \XMLReader
     */
    protected $xml;

    /**
     * Reader constructor.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->xml = new \XMLReader();
        $this->xml->open($url);
        while ($this->xml->read() && $this->xml->name != 'ORDER') {
        }
    }

    /**
     * @return Orders
     */
    public function loadOrders(): Orders
    {
        $order = new Orders();

        while($this->xml->name == 'ORDER') {
            $order->addOrder($this->loadOrder());
            $this->next();
        }

        return $order;
    }

    /**
     * @return Order
     */
    public function loadOrder(): ?Order
    {
        if ($this->xml->name != 'ORDER') {
            return null;
        }

        $orderXml = new \SimpleXMLElement($this->xml->readOuterXml());

        $order = new Order(
            (string) $orderXml->CODE,
            new Carbon((string) $orderXml->DATE),
            (string) $orderXml->STATUS,
            (string) $orderXml->PACKAGE_NO,
        );

        foreach ($orderXml->ORDER_ITEMS->ITEM as $itemXml) {
            $order->addItem(new Item(
                $itemXml->TYPE,
                $itemXml->CODE,
                intval($itemXml->AMOUNT),
                str_replace(',', '.', $itemXml->PRICE_WO_VAT)
            ));
        }

        return $order;
    }

    public function next()
    {
        return $this->xml->next('ORDER');
    }
}