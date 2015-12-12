<?php

namespace C3P0\App;

class GithubClient
{
    protected $curl_handler;
    protected $username;
    
    public function __construct()
    {
        $this->curl_handler = curl_init();
        curl_setopt($this->curl_handler, CURLOPT_USERAGENT, 'C3P0');
        curl_setopt($this->curl_handler, CURLOPT_RETURNTRANSFER, true);
    }
    
    public function getRepositories()
    {
        curl_setopt($this->curl_handler, CURLOPT_URL, "https://api.github.com/users/".$this->username."/repos");
        $repos_json = curl_exec($this->curl_handler);
        $repos_array = json_decode($repos_json, true);
        return $repos_array;
    }
    
    public function getRepositoriesCount()
    {
        return count($this->getRepositories());
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
    }
}