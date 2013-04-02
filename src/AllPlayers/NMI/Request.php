<?php

namespace AllPlayers\NMI;

/**
 * Defines a request to be made against the NMI payment gateway service.
 */
interface Request
{
    /**
     * Converts the request to an array that can be used when executing the
     * request against the NMI payment gateway service.
     *
     * @return array
     *   Array representation of the request.
     */
    public function toArray();
}
