<?php

namespace AllPlayers\NMI\Request\CustomerVault;

use AllPlayers\NMI\Request;

/**
 * Defines a delete customer request to be made against the NMI payment gateway.
 */
class Delete implements Request
{
    /**
     * Id of the customer to delete.
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
     * The type of this request as recognized by the NMI payment gateway.
     *
     * @var string
     */
    protected $type = 'delete_customer';

    /**
     * Converts the request to an array that can be used when executing the
     * request against the NMI payment gateway service.
     *
     * @return array
     *   Array representation of the request.
     */
    public function toArray()
    {
        return array(
            'customer_vault' => $this->type,
            'customer_vault_id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
        );
    }
}
