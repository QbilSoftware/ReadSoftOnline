<?php


namespace Qbil\ReadSoftOnline\Models;


interface InvoiceInterface
{
    public function addInvoiceLine(InvoiceLineInterface $invoiceLine);
    public function getRelation();
    public function getInvoiceType();
    public function getSubsidiary();
    public function getSupplierInvoiceNumber();
    public function getAmount();
    public function getVatAmount();
    public function getInvoiceDate();
    public function getDueDate();
    public function getCurrency();
    public function getTheirVatRegistration();
    public function getOurVatRegistration();
    /**
     * @return InvoiceLineInterface[]
     */
    public function getInvoiceLines();
    public function getOrder();
    public function getContract();
    public function getVat();
}