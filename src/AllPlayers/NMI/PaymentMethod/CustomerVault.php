<?php

namespace AllPlayers\NMI\PaymentMethod;

use AllPlayers\NMI\PaymentMethod;

/**
 * Defines a customer vault payment method for use with the NMI payment gateway.
 */
class CustomerVault implements PaymentMethod
{
    /**
     * The verification code for the credit card, usually three or four digits.
     *
     * @var string
     */
    public $customerVaultId;

    /**
     * Converts the payment method to an array that can be used in a request.
     *
     * @return array
     *  Array of data that represents the payment method.
     */
    public function toArray()
    {
        return array(
            'customer_vault_id' => $this->customerVaultId,
        );
    }
}
