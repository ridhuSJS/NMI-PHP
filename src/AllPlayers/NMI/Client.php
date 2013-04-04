<?php

namespace AllPlayers\NMI;

use Guzzle\Service\Client as HttpClient;

/**
 * NMI payment gateway client.
 */
class Client
{
    /**
     * URL to the NMI payment gateway that all requests will be made against.
     *
     * @var string
     */
    const GATEWAY_URL = 'https://secure.networkmerchants.com/api/transact.php';

    /**
     * Headers that will be sent with each request,
     *
     * @var array
     */
    protected $headers = array(
      'Content-Type: application/x-www-form-urlencoded',
    );

    /**
     * Retrieve a transaction service object using this client.
     *
     * @return \AllPlayers\NMI\TransactionService
     *   A transaction service object using this object as the client.
     */
    public function transaction()
    {
        return new TransactionService($this);
    }

    /**
     * Makes a POST request to the NMI payment gateway service.
     *
     * @param array $data
     *   Data to be posted in the request.
     *
     * @return \Guzzle\Http\Message\Response
     *   Response from the service.
     */
    public function post($data)
    {
        $client = new HttpClient();
        return $client->post(self::GATEWAY_URL, $this->headers, (string) $data)->send();
    }
}
