<?php

namespace AllPlayers\NMI;

/**
 * Class to handle the actual transactions made to the client.
 */
class TransactionService
{
    /**
     * NMI client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Contructor.
     *
     * @param Client $client
     *   NMI client to be used for transactions.
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Executes a request.
     *
     * @param Request $request
     *   The request to be executed.
     *
     * @return array
     *   Response from the NMI service parsed as an array.
     */
    public function execute(Request $request)
    {
        $http_response = $this->client->post(http_build_query($request->toArray()));
        parse_str($http_response->getBody(true), $response_array);

        return $response_array;
    }
}
