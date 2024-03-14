<?php
/**
 * Created by PhpStorm.
 * User: faizan
 * Date: 11/12/18
 * Time: 4:03 PM.
 */

namespace Qbil\ReadSoftOnline\Models;

use Qbil\ReadSoftOnline\Util;

class Invoice implements InvoiceInterface
{
    public function __construct(Document $document, bool $includeInvoiceLines = true)
    {
        $this->relation = Util::extract($document->Parties, 'supplier', 'ExternalId');
        $this->trackId = $document->TrackId;
        $this->creditInvoice = Util::extract($document->HeaderFields, 'creditinvoice');
        $this->subsidiary = Util::extract($document->Parties, 'buyer', 'ExternalId');
        $this->supplierInvoiceNumber = Util::extract($document->HeaderFields, 'invoicenumber');
        $this->amount = Util::extract($document->HeaderFields, 'invoicetotalvatexcludedamount');
        $this->vatAmount = Util::extract($document->HeaderFields, 'invoicetotalvatamount');
        $this->invoiceDate = \DateTime::createFromFormat('Ymd', Util::extract($document->HeaderFields, 'invoicedate')) ?: null;
        $this->dueDate = \DateTime::createFromFormat('Ymd', Util::extract($document->HeaderFields, 'invoiceduedate')) ?: null;
        $this->currency = Util::extract($document->HeaderFields, 'invoicecurrency');
        $this->theirVatRegistration = Util::extract($document->HeaderFields, 'suppliervatregistrationnumber');
        $this->ourVatRegistration = Util::extract($document->HeaderFields, 'CustomerVATRegistrationNumber');
        $this->orderNumber = Util::extract($document->HeaderFields, 'invoiceordernumber');
        $this->contract = Util::extract($document->HeaderFields, 'Inkoopcontract');
        $this->vat = Util::extract($document->HeaderFields, 'vatCode');
        $this->dieselSurcharge = Util::extract($document->HeaderFields, 'DieselSurcharge');

        if ($includeInvoiceLines) {
            foreach (array_column(Util::extract($document->Tables, 'LineItem', 'TableRows'), 'ItemFields') as $line) {
                $invoiceLine = new InvoiceLine(
                    Util::extract($line, 'LIT_OrderNumber') ?? null,
                    Util::extract($line, 'LIT_DeliveredQuantity') ?? 0,
                    Util::extract($line, 'LIT_VatExcludedAmount') ?? 0,
                    Util::extract($line, 'LIT_UnitPriceAmount') ?? 0,
                    Util::extract($line, 'LIT_Inkoopcontract') ?? null,
                    $document->DocumentSubType,
                    null,
                    Util::extract($line, 'LIT_qtyPerBox') ?? 0,
                    Util::extract($line, 'LIT_nrBoxes') ?? 0,
                    $this
                );

                $this->addInvoiceLine($invoiceLine);
            }
        }
    }

    private $relation;
    private $trackId;
    private $creditInvoice;
    private $subsidiary;
    private $supplierInvoiceNumber;
    private $amount;
    private $vatAmount;
    private $invoiceDate;
    private $dueDate;
    private $currency;
    private $theirVatRegistration;
    private $ourVatRegistration;
    private $orderNumber;
    private $contract;
    private $vat;
    private $dieselSurcharge;
    private $invoiceLines = [];

    public function addInvoiceLine(InvoiceLineInterface $invoiceLine)
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
    public function getTrackId()
    {
        return $this->trackId;
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
     * @return InvoiceLine[]
     */
    public function getInvoiceLines()
    {
        return $this->invoiceLines;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->orderNumber;
    }

    /**
     * @return mixed
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @return mixed
     */
    public function getDieselSurcharge()
    {
        return $this->dieselSurcharge;
    }

    /**
     * @return mixed
     */
    public function isCreditInvoice()
    {
        return 'true' === $this->creditInvoice;
    }

    public function getAmount()
    {
        if (!$this->dieselSurcharge || $this->getDieselSurcharge() < 0) {
            return $this->amount;
        }

        return (($this->dieselSurcharge * $this->amount) / 100) + $this->amount;
    }
}
