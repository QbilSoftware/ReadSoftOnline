<?php


namespace Qbil\ReadSoftOnline\Models;


interface InvoiceInterface
{
    /**
     * @return InvoiceLineInterface[]
     */
    public function addInvoiceLine();
    public function getRelation();
    public function getSubsidiary();
    public function getSupplierInvoiceNumber();
    public function getAmount();
    public function getVatAmount();
    public function getInvoiceDate();
    public function getDueDate();
    public function getCurrency();
    public function getTheirVatRegistration();
    public function getOurVatRegistration();
    public function getInvoiceLines();
    public function getOrder();
    public function getContract();
}