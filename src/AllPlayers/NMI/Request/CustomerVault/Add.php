<?php

namespace AllPlayers\NMI\Request\CustomerVault;

use AllPlayers\NMI\Request;
use AllPlayers\NMI\PaymentMethod;
use AllPlayers\NMI\Model\Billing;
use AllPlayers\NMI\Model\Shipping;
use AllPlayers\NMI\Exception\MissingParameterException;

/**
 * Defines an add customer request to be made against the NMI payment gateway.
 */
class Add implements Request
{
    /**
     * The currency used for the customer, formatted according to ISO-4217.
     *
     * @var string
     *
     * @link http://en.wikipedia.org/wiki/ISO_4217#Active_codes
     */
    public $currency;

    /**
     * Optional unique id to give to this customer vault entry.
     *
     * If no value is provided one will be generated and included in the
     * response.
     *
     * @var string
     */
    public $id;

    /**
     * Password for the merchant account.
     *
     * @var string
     */
    public $password;

    /**
     * Username for the merchant account.
     *
     * @var string
     */
    public $username;

    /**
     * Billing details for this customer.
     *
     * @var Billing
     */
    protected $billingDetails;

    /**
     * Payment method used for this customer.
     *
     * @var PaymentMethod
     */
    protected $paymentMethod;

    /**
     * Shipping details for this customer.
     *
     * @var Shipping
     */
    protected $shippingDetails;

    /**
     * The type of this request as recognized by the NMI payment gateway.
     *
     * @var string
     */
    protected $type = 'add_customer';

    /**
     * Sets the billing details for the customer.
     *
     * @param Billing $billing
     *   Billing details for this customer.
     */
    public function setBillingDetails(Billing $billing)
    {
        $this->billingDetails = $billing;
    }

    /**
     * Sets the payment method for the customer.
     *
     * @param PaymentMethod $method
     *   Payment method used for this customer.
     */
    public function setPaymentMethod(PaymentMethod $method)
    {
        $this->paymentMethod = $method;
    }

    /**
     * Sets the shipping details for the customer.
     *
     * @param Shipping $shipping
     *   Shipping details for this customer.
     */
    public function setShippingDetails(Shipping $shipping)
    {
        $this->shippingDetails = $shipping;
    }

    /**
     * Converts the request to an array that can be used when executing the
     * request against the NMI payment gateway service.
     *
     * @return array
     *   Array representation of the request.
     */
    public function toArray()
    {
        // Make sure a payment method was set.
        if (empty($this->paymentMethod)) {
            throw new MissingParameterException('A payment method is required to add a new customer.');
        }

        $data = array(
            'customer_vault' => $this->type,
            'customer_vault_id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'currency' => $this->currency,
        );

        // Add the payment method to the data.
        $data = array_merge($data, $this->paymentMethod->toArray());

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
