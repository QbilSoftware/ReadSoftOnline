<?php
/**
 * Created by PhpStorm.
 * User: faizan
 * Date: 11/12/18
 * Time: 4:03 PM
 */

namespace Qbil\ReadSoftOnline\Models;


class Invoice
{
    public function __construct(Document $document)
    {
        $this->relation = $this->extract($document->Parties, 'supplier', 'ExternalId');
        $this->subsidiary = $this->extract($document->Parties, 'buyer', 'ExternalId');
        $this->supplierInvoiceNumber = $this->extract($document->HeaderFields, 'invoicenumber');
        $this->amount = $this->extract($document->HeaderFields, 'invoicetotalvatexcludedamount');
        $this->vatAmount = $this->extract($document->HeaderFields, 'invoicetotalvatamount');
        $this->invoiceDate = \DateTime::createFromFormat('Ymd', $this->extract($document->HeaderFields, 'invoicedate'));
        $this->dueDate = \DateTime::createFromFormat('Ymd', $this->extract($document->HeaderFields, 'invoiceduedate'));
        $this->currency = $this->extract($document->HeaderFields, 'invoicecurrency');
        $this->theirVatRegistration = $this->extract($document->HeaderFields, 'suppliervatregistrationnumber');
        $this->ourVatRegistration = $this->extract($document->HeaderFields, 'CustomerVATRegistrationNumber');

        foreach (array_column($this->extract($document->Tables, 'LineItem', 'TableRows'), 'ItemFields') as $line) {
            $invoiceLine = new InvoiceLine(
                $this->extract($line, 'LIT_OrderNumber'),
                $this->extract($line, 'LIT_DeliveredQuantity'),
                $this->extract($line, 'LIT_VatExcludedAmount'),
                $this->extract($line, 'LIT_UnitPriceAmount'),
                $document->DocumentSubType
            );

            $this->addInvoiceLine($invoiceLine);
        }
    }

    private $relation;
    private $subsidiary;
    private $supplierInvoiceNumber;
    private $amount;
    private $vatAmount;
    private $invoiceDate;
    private $dueDate;
    private $currency;
    private $theirVatRegistration;
    private $ourVatRegistration;
    private $invoiceLines = [];

    public function addInvoiceLine(InvoiceLine $invoiceLine)
    {
        $this->invoiceLines[] = $invoiceLine;
    }

    /**
     * @return mixed
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @return mixed
     */
    public function getSubsidiary()
    {
        return $this->subsidiary;
    }

    /**
     * @return mixed
     */
    public function getSupplierInvoiceNumber()
    {
        return $this->supplierInvoiceNumber;
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
    public function getVatAmount()
    {
        return $this->vatAmount;
    }

    /**
     * @return bool|\DateTime
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * @return bool|\DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getTheirVatRegistration()
    {
        return $this->theirVatRegistration;
    }

    /**
     * @return mixed
     */
    public function getOurVatRegistration()
    {
        return $this->ourVatRegistration;
    }

    /**
     * @return array
     */
    public function getInvoiceLines()
    {
        return $this->invoiceLines;
    }

    private function extract(array $property, $key, $subKey = 'Text')
    {
        return $property[array_search($key, array_column($property, 'Type'))][$subKey];
    }
}