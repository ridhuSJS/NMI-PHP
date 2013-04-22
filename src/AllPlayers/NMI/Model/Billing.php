<?php

namespace AllPlayers\NMI\Model;

/**
 * Defines billing details to be used by the NMI payment gateway.
 */
class Billing
{
    /**
     * Name of the company to be billed for the transaction.
     *
     * @var string
     */
    public $company;

    /**
     * Email address of the person or organization to be billed for the
     * transaction.
     *
     * @var string
     */
    public $email;

    /**
     * Fax number of the person or organization to be billed for the
     * transaction.
     *
     * @var string
     */
    public $fax;

    /**
     * First name of the individual to be billed for the transaction.
     *
     * @var string
     */
    public $firstName;

    /**
     * Last name of the individual to be billed for the transaction.
     *
     * @var string
     */
    public $lastName;

    /**
     * Phone number of the person or organization to be billed for the
     * transaction.
     *
     * @var string
     */
    public $phone;

    /**
     * Address of the person or organization to be billed for the transaction.
     *
     * @var Address
     */
    protected $address;

    /**
     * Returns the currently set billing address.
     *
     * @return Address
     *   Address of the person or organization to be billed for the transaction.
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the billing address.
     *
     * @param Address $address
     *   Address of the person or organization to be billed for the transaction.
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Converts the billing details to an array that can be used in a request.
     *
     * @return array
     *   Array of data that represents the billing details.
     */
    public function toArray()
    {
        $data = array(
            'firstname' => $this->firstName,
            'lastname' => $this->lastName,
            'company' => $this->company,
            'phone' => $this->phone,
            'fax' => $this->fax,
            'email' => $this->email,
        );

        // If a billing address was specified then add it to the data.
        if (!empty($this->address)) {
            $data = array_merge($data, $this->address->toArray());
        }

        return $data;
    }
}
