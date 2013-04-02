<?php

namespace AllPlayers\NMI\Model;

/**
 * Defines shipping details to be used by the NMI payment gateway.
 */
class Shipping
{
    /**
     * Name of the company that the sale will be shipped to.
     *
     * @var string
     */
    public $company;

    /**
     * Email address of the person or organization that the sale will be shipped
     * to.
     *
     * @var string
     */
    public $email;

    /**
     * First name of the individual recipient that the sale will be shipped to.
     *
     * @var string
     */
    public $firstName;

    /**
     * Last name of the individual recipient that the sale will be shipped to.
     *
     * @var string
     */
    public $lastName;

    /**
     * Address of the person or organization that the sale will be shipped to.
     *
     * @var Address
     */
    protected $address;

    /**
     * Sets the shipping address.
     *
     * @param Address $address
     *   Address of the person or organization that the sale will be shipped to.
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Converts the shipping details to an array that can be used in a request.
     *
     * @return array
     *   Array of data that represents the shipping details.
     */
    public function toArray()
    {
        $data = array(
            'shipping_firstname' => $this->firstName,
            'shipping_lastname' => $this->lastName,
            'shipping_company' => $this->company,
            'shipping_email' => $this->email,
        );

        // If a shipping address was specified then add to the data.
        if (!empty($this->address)) {
            // Iterate over the array representation of the address, appending
            // the shipping key to each key from the address before adding it to
            // the data.
            foreach ($this->address->toArray() as $part => $value) {
                $data['shipping_' . $part] = $value;
            }
        }

        return $data;
    }
}
