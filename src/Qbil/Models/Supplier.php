<?php
/**
 * Created by PhpStorm.
 * User: faizan
 * Date: 7/12/18
 * Time: 7:27 PM
 */

namespace Qbil\ReadSoftOnline\Models;

class Supplier implements \JsonSerializable
{
    public function __construct($id, $supplierNumber, $name, $description = null, $taxRegistrationNumber = null, $street = null, $postalCode = null, $city = null, $countryName = null, $paymentTerm = null, $paymentMethod = null, $currencyCode = null, $location = null, $state = null, $faxNumber = null, $taxCode = null)
    {
        $this->id = $id;
        $this->supplierNumber = $supplierNumber;
        $this->name = $name;
        $this->description = $description;
        $this->taxRegistrationNumber = $taxRegistrationNumber;
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->countryName = $countryName;
        $this->paymentTerm = $paymentTerm;
        $this->paymentMethod = $paymentMethod;
        $this->currencyCode = $currencyCode;
        $this->location = $location;
        $this->state = $state;
        $this->faxNumber = $faxNumber;
        $this->taxCode = $taxCode;
    }

    private $supplierNumber;

    private $name;

    private $description;

    private $taxRegistrationNumber;

    private $street;

    private $postalCode;

    private $city;

    private $countryName;

    private $paymentTerm;

    private $paymentMethod;

    private $currencyCode;

    private $id;

    private $location;

    private $state;

    private $faxNumber;

    private $taxCode;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @return mixed
     */
    public function getTaxRegistrationNumber()
    {
        return $this->taxRegistrationNumber;
    }


    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }


    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }


    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }


    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->countryName;
    }


    /**
     * @return mixed
     */
    public function getPaymentTerm()
    {
        return $this->paymentTerm;
    }


    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }


    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }


    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }


    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }


    /**
     * @return mixed
     */
    public function getTaxCode()
    {
        return $this->taxCode;
    }


    /**
     * @return mixed
     */
    public function getSupplierNumber(): string
    {
        return $this->supplierNumber;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return array_reduce(
            array_keys($supplier = get_object_vars($this)),
            function ($acc, $property) use ($supplier) {
                $acc[ucfirst($property)] = $supplier[$property];
                return $acc;
            },
            []
        );
    }
}