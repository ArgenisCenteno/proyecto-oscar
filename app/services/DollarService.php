<?php

namespace App\Services;

use GuzzleHttp\Client;

class DollarService
{
    protected $client;
    protected $baseUrl = 'https://ve.dolarapi.com/v1/dolares/oficial';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getDollarPrice()
    {
        $response = $this->client->get($this->baseUrl);
    
        return json_decode($response->getBody(), true);
    }
}
