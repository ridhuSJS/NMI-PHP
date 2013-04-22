<?php

namespace AllPlayers\NMI\Request\CustomerVault;

use AllPlayers\NMI\Request;
use AllPlayers\NMI\PaymentMethod;
use AllPlayers\NMI\Model\Billing;
use AllPlayers\NMI\Model\Shipping;

/**
 * Defines an update customer request to be made against the NMI payment gateway.
 */
class Update extends Add
{
    /**
     * Id of the customer to update.
     *
     * @var string
     */
    public $id;

    /**
     * The type of this request as recognized by the NMI payment gateway.
     *
     * @var string
     */
    protected $type = 'update_customer';

    /**
     * Converts the request to an array that can be used when executing the
     * request against the NMI payment gateway service.
     *
     * @return array
     *   Array representation of the request.
     */
    public function toArray()
    {
        $data = array(
            'customer_vault' => $this->type,
            'customer_vault_id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'currency' => $this->currency,
        );

        // If a payment method was specified then add it to the data.
        if (!empty($this->paymentMethod)) {
            $data = array_merge($data, $this->paymentMethod->toArray());
        }

        // If billing details were specified then add them to the data.
        if (!empty($this->billingDetails)) {
            $data = array_merge($data, $this->billingDetails->toArray());
        }

        // If shipping details were specified then add them to the data.
        if (!empty($this->shippingDetails)) {
            $data = array_merge($data, $this->shippingDetails->toArray());
        }

        return $data;
    }
}
