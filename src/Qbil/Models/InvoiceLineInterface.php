<?php


namespace Qbil\ReadSoftOnline\Models;


interface InvoiceLineInterface
{
    public function getOrder();
    public function getQuantity();
    public function getAmount();
    public function getEstimatedAmount();
    public function getPrice();
    public function getType();
    public function getAllocatedInvoice();
    public function getPurchaseContract();
}