<?php

namespace AllPlayers\NMI\Exception;

use RuntimeException;

/**
 * Exception thrown when a request is missing a parameter that is required in
 * order to execute the request,
 */
class MissingParameterException extends RuntimeException
{

}
