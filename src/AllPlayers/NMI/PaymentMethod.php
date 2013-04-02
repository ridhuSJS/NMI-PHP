<?php

namespace AllPlayers\NMI;

/**
 * Defines a payment method that can be processed by the NMI payment gateway.
 */
interface PaymentMethod
{
    /**
     * Converts the payment method to an array that can be used in a request.
     *
     * @return array
     *   Array of data that represents the payment method.
     */
    public function toArray();
}
