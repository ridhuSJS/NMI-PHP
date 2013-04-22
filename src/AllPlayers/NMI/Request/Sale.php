<?php

namespace AllPlayers\NMI\Request;

use AllPlayers\NMI\Request;

use AllPlayers\NMI\Exception\MissingParameterException;
use AllPlayers\NMI\PaymentMethod;

use AllPlayers\NMI\Model\Address;
use AllPlayers\NMI\Model\Billing;
use AllPlayers\NMI\Model\Shipping;
use AllPlayers\NMI\Model\Order;

/**
 * Defines a sale request to be made against the NMI payment gateway.
 */
class Sale implements Request
{
    /**
     * The amount of the sale.
     *
     * @var float
     */
    public $amount;

    /**
     * The currency used for the sale, formatted according to ISO-4217.
     *
     * @var string
     *
     * @link http://en.wikipedia.org/wiki/ISO_4217#Active_codes
     */
    public $currency;

    /**
     * The IP Address of the card holder.
     *
     * @var string
     */
    public $ipAddress;

    /**
     * Password for the merchant account.
     *
     * @var string
     */
    public $password;

    /**
     * Processor id if there are multiple MIDs under the same merchant account.
     *
     * @var string
     */
    public $processorId;

    /**
     * Purchase order number supplied by the card holder.
     *
     * @var string
     */
    public $purchaseOrderNumber;

    /**
     * Shipping amount for the sale.
     *
     * @var float
     */
    public $shipping;

    /**
     * Tax amount for the sale.
     *
     * @var float
     */
    public $tax;

    /**
     * Username for the merchant account.
     *
     * @var string
     */
    public $username;

    /**
     * Which validation processor to use.
     *
     * @var string
     */
    public $validation;

    /**
     * Billing details for this sale.
     *
     * @var Billing
     */
    protected $billingDetails;

    /**
     * The order that corresponds to this sale.
     *
     * @var Order
     */
    protected $order;

    /**
     * Payment method used for this sale.
     *
     * @var PaymentMethod
     */
    protected $paymentMethod;

    /**
     * Shipping details for this sale.
     *
     * @var Shipping
     */
    protected $shippingDetails;

    /**
     * The type of this request as recognized by the NMI payment gateway.
     *
     * @var string
     */
    protected $type = 'sale';

    /**
     * Returns the currently set billing details for this sale.
     *
     * @return Billing
     *   Billing details for this sale.
     */
    public function getBillingDetails()
    {
        return $this->billingDetails;
    }

    /**
     * Sets the billing details for the sale.
     *
     * @param Billing $billing
     *   Billing details for this sale.
     */
    public function setBillingDetails(Billing $billing)
    {
        $this->billingDetails = $billing;
    }

    /**
     * Returns the currently set order for this sale.
     *
     * @return Order
     *   The order that corresponds to this sale.
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Sets the order for the sale.
     *
     * @param Order $order
     *   The order that corresponds to this sale.
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Returns the currently set payment method for this sale.
     *
     * @return PaymentMethod
     *   Payment method used for this sale.
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Sets the payment method for the sale.
     *
     * @param PaymentMethod $method
     *   Payment method used for this sale.
     */
    public function setPaymentMethod(PaymentMethod $method)
    {
        $this->paymentMethod = $method;
    }

    /**
     * Returns the currently set shipping details for this sale.
     *
     * @return Shipping
     *   Shipping details for this sale.
     */
    public function getShippingDetails()
    {
        return $this->shippingDetails;
    }

    /**
     * Sets the shipping details for the sale.
     *
     * @param Shipping $shipping
     *   Shipping details for this sale.
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
            throw new MissingParameterException('A payment method is required to process a sale.');
        }

        $data = array(
            'type' => $this->type,
            'username' => $this->username,
            'password' => $this->password,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'processor_id' => $this->processorId,
            'ipaddress' => $this->ipAddress,
            'tax' => $this->tax,
            'shipping' => $this->shipping,
            'ponumber' => $this->purchaseOrderNumber,
            'validation' => $this->validation,
        );

        // Add the payment method to the data.
        $data = array_merge($data, $this->paymentMethod->toArray());

        // If an order was specified then add it to the data.
        if (!empty($this->order)) {
            $data = array_merge($data, $this->order->toArray());
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
