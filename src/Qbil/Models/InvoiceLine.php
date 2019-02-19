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
    public function __construct($order, $quantity, $amount, $price, $purchaseContract, $type, $allocatedInvoice = null)
    {
        $this->order = $order;
        $this->quantity = $quantity;
        $this->amount = $amount;
        $this->price = $price;
        $this->purchaseContract = $purchaseContract;
        $this->type = $type;
        $this->allocatedInvoice = $allocatedInvoice;
    }

    private $order;
    private $quantity;
    private $amount;
    private $price;
    private $purchaseContract;
    private $type;
    private $allocatedInvoice;

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
     * @return mixed
     */
    public function getAllocatedInvoice()
    {
        return $this->allocatedInvoice;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param $allocatedInvoice
     */
    public function setAllocatedInvoice($allocatedInvoice)
    {
        $this->allocatedInvoice = $allocatedInvoice;
    }

    /**
     * @return mixed
     */
    public function getPurchaseContract()
    {
        return $this->purchaseContract;
    }
}
