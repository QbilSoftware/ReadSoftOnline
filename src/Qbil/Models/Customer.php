<?php
/**
 * Created by PhpStorm.
 * User: faizan
 * Date: 7/12/18
 * Time: 9:08 PM
 */

namespace Qbil\ReadSoftOnline\Models;


class Customer
{
    public function __construct(array $customer)
    {
        $this->id = $customer['id'];
        $this->name = $customer['name'];
        $this->externalId = $customer['externalId'];
        $this->activationStatus = $customer['activationStatus'];
        $this->classificationValue = $customer['classificationValue'];
    }

    private $id;

    private $name;

    private $externalId;

    private $activationStatus;

    private $classificationValue;

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
    public function getActivationStatus()
    {
        return $this->activationStatus;
    }

    /**
     * @return mixed
     */
    public function getClassificationValue()
    {
        return $this->classificationValue;
    }
}