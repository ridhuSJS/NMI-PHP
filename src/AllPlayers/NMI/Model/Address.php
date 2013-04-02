<?php

namespace AllPlayers\NMI\Model;

/**
 * Defines an address to be used by the NMI payment gateway.
 */
class Address
{
    /**
     * The city portion of the address.
     *
     * @var string
     */
    public $city;

    /**
     * The country portion of the address, formatted according to ISO-3166-1
     * alpha 3.
     *
     * @var string
     *
     * @link http://en.wikipedia.org/wiki/ISO_3166-1_alpha-3
     */
    public $country;

    /**
     * The state portion of the address.
     *
     * @var string
     */
    public $state;

    /**
     * The postal code portion of the address.
     *
     * @var string
     */
    public $postalCode;

    /**
     * The first street address portion of the address.
     *
     * @var string
     */
    public $street1;

    /**
     * The second street address portion of the address.
     *
     * @var string
     */
    public $street2;

    /**
     * Converts the address to an array that can be used in a request.
     *
     * @return array
     *   Array of data that represents the address.
     */
    public function toArray()
    {
        return array(
            'address1' => $this->street1,
            'address2' => $this->street2,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->postalCode,
            'country' => $this->country,
        );
    }
}

