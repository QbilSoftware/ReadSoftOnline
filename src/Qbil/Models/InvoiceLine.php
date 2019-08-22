<?php
/**
 * Created by PhpStorm.
 * User: faizan
 * Date: 11/12/18
 * Time: 4:07 PM.
 */

namespace Qbil\ReadSoftOnline\Models;

class InvoiceLine implements InvoiceLineInterface
{
    public function __construct(string $order, float $quantity, float $amount, float $price, string $purchaseContract, string $type, ?string $allocatedInvoice = null)
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
     * @return float
     *
     * This method is for User-land code (if ever needed to extend this class)
     */
    public function getEstimatedAmount()
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
     * @return mixed
     */
    public function getPurchaseContract()
    {
        return $this->purchaseContract;
    }
}
