<?php
/**
 * Created by PhpStorm.
 * User: faizan
 * Date: 7/12/18
 * Time: 9:08 PM
 */

namespace Qbil\ReadSoftOnline\Models;


class Buyer
{
    public function __construct(array $buyer)
    {
        $this->id = $buyer['Id'];
        $this->name = $buyer['Name'];
        $this->externalId = $buyer['ExternalId'];
        $this->vatNumber = $buyer['VatNumber'];
        $this->addressCountry = $buyer['AddressCountry'];
        $this->addressStreetAddress = $buyer['AddressStreetAddress'];
        $this->addressPostcode = $buyer['AddressPostcode'];
        $this->addressCity = $buyer['AddressCity'];
        $this->phoneNumber = $buyer['PhoneNumber'];
        $this->fax = $buyer['Fax'];
        $this->alternativeName1 = $buyer['AlternativeName1'];
        $this->alternativeName2 = $buyer['AlternativeName2'];
        $this->alternativeName3 = $buyer['AlternativeName3'];
        $this->organizationNumber = $buyer['OrganizationNumber'];
        $this->addressState = $buyer['AddressState'];
    }

    private $id;

    private $name;

    private $externalId;

    private $vatNumber;

    private $addressCountry;

    private $addressStreetAddress;

    private $addressPostcode;

    private $addressCity;

    private $phoneNumber;

    private $fax;

    private $alternativeName1;

    private $alternativeName2;

    private $alternativeName3;

    private $organizationNumber;

    private $addressState;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @return mixed
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     * @return mixed
     */
    public function getAddressCountry()
    {
        return $this->addressCountry;
    }

    /**
     * @return mixed
     */
    public function getAddressStreetAddress()
    {
        return $this->addressStreetAddress;
    }

    /**
     * @return mixed
     */
    public function getAddressPostcode()
    {
        return $this->addressPostcode;
    }

    /**
     * @return mixed
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @return mixed
     */
    public function getAlternativeName1()
    {
        return $this->alternativeName1;
    }

    /**
     * @return mixed
     */
    public function getAlternativeName2()
    {
        return $this->alternativeName2;
    }

    /**
     * @return mixed
     */
    public function getAlternativeName3()
    {
        return $this->alternativeName3;
    }

    /**
     * @return mixed
     */
    public function getOrganizationNumber()
    {
        return $this->organizationNumber;
    }

    /**
     * @return mixed
     */
    public function getAddressState()
    {
        return $this->addressState;
    }
}