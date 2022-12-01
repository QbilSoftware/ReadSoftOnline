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
    public function __construct(
        string $order,
        float $quantity,
        float $amount,
        float $price,
        string $purchaseContract,
        string $type,
        ?string $allocatedInvoice = null,
        ?float $qtyPerBox = 0,
        ?int $noOfBoxes = 0,
        ?Invoice $invoice = null
    )
    {
        $this->order = $order;
        $this->quantity = $quantity;
        $this->amount = $amount;
        $this->price = $price;
        $this->purchaseContract = $purchaseContract;
        $this->type = $type;
        $this->allocatedInvoice = $allocatedInvoice;
        $this->qtyPerBox = $qtyPerBox;
        $this->noOfBoxes = $noOfBoxes;
        $this->invoice = $invoice;
    }

    private $order;
    private $quantity;
    private $amount;
    private $price;
    private $purchaseContract;
    private $type;
    private $allocatedInvoice;
    public $qtyPerBox;
    public $noOfBoxes;
    public $invoice;

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
        if ($this->qtyPerBox > 0 || $this->noOfBoxes > 0) {
            return $this->qtyPerBox * $this->qtyPerBox;
        }

        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        if (!$this->invoice) {
            return $this->amount;
        }

        if ($this->invoice->getDieselSurcharge() < 0) {
            return (($this->invoice->getDieselSurcharge() * $this->amount) / 100) + $this->amount;
        }

        return $this->amount;
    }

    /**
     * @return float
     *
     * This method is for User-land code (if ever needed to extend this class)
     */
    public function getEstimatedAmount()
    {
        if (!$this->invoice || $this->invoice->getDieselSurcharge() < 0) {
            return $this->amount;
        }

        return (($this->invoice->getDieselSurcharge() * $this->amount) / 100) + $this->amount;
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

    /**
     * @return mixed
     */
    public function getVatCode()
    {
        return null;
    }

    public function setAllocatedInvoice(string $allocatedInvoice)
    {
        $this->allocatedInvoice = $allocatedInvoice;
    }
}
