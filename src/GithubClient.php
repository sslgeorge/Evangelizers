<?php

namespace C3P0\App;

class GithubClient
{
    protected $curl_handler;
    
    public function __construct()
    {
        $this->curl_handler = curl_init();
        curl_setopt($this->curl_handler, CURLOPT_USERAGENT, 'C3P0');
        curl_setopt($this->curl_handler, CURLOPT_RETURNTRANSFER, true);
    }
    
    public function getRepos($username)
    {
        curl_setopt($this->curl_handler, CURLOPT_URL, "https://api.github.com/users/$username/repos");
        echo (curl_exec($this->curl_handler));
    }
}