<?php

namespace C3P0\App;

use GithubClient;

class EvangelistStatus
{
    protected $username;
    protected $api_client;
    
    public function __construct($username, $api_client)
    {
        $this->username = $username;
        $this->api_client = $api_client;
    }
}