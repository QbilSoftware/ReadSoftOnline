<?php
/**
 * Created by PhpStorm.
 * User: faizan
 * Date: 11/12/18
 * Time: 4:07 PM.
 */

namespace Qbil\ReadSoftOnline\Models;

class InvoiceLine
{
    public function __construct($order, $quantity, $amount, $price, $type)
    {
        $this->order = $order;
        $this->quantity = $quantity;
        $this->amount = $amount;
        $this->price = $price;
        $this->type = $type;
    }

    private $order;
    private $quantity;
    private $amount;
    private $price;
    private $type;

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
