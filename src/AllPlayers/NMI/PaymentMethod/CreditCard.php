<?php

namespace AllPlayers\NMI\PaymentMethod;

use AllPlayers\NMI\Exception\MissingParameterException;
use AllPlayers\NMI\PaymentMethod;

use DateTime;

/**
 * Defines a credit card payment method for use with the NMI payment gateway.
 */
class CreditCard implements PaymentMethod
{
    /**
     * The verification code for the credit card, usually three or four digits.
     *
     * @var integer
     */
    public $cvv;

    /**
     * The credit card number that the transaction will be made against.
     *
     * @var string
     */
    public $number;

    /**
     * The expiration date of the credit card.
     *
     * @var DateTime
     */
    protected $expiration;

    /**
     * The type of this payment method as recognized by the NMI payment gateway.
     *
     * @var string
     */
    protected $type = 'creditcard';

    /**
     * Sets the expiration date for the credit card.
     *
     * @param DateTime $expiration
     *   The expiration date of the credit card.
     */
    public function setExpiration(DateTime $expiration)
    {
        $this->expiration = $expiration;
    }

    /**
     * Converts the payment method to an array that can be used in a request.
     *
     * @throws MissingParameterException
     *
     * @return array
     *  Array of data that represents the payment method.
     */
    public function toArray()
    {
        // Make sure an expiration date was set.
        if (empty($this->expiration)) {
            throw new MissingParameterException('An expiration date is required for credit card transactions.');
        }

        return array(
            'payment' => $this->type,
            'ccnumber' => $this->number,
            'cvv' => $this->cvv,
            'ccexp' => $this->expiration->format('my'),
        );
    }
}
