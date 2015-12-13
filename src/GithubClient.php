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

    public function __call($methodName, $args)
    {
        $name = strtolower(substr($methodName, 3, strlen($methodName)-3));
        $data = $this->get($name);
        return $data;
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

    public function getRepositoriesName()
    {
        return $this->get('name');
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    private function get($key)
    {
        $repos = $this->getRepositories();
        $result = [];
        foreach ($repos as $data) {
            if (array_key_exists($key, $data)) {
                $result[] = $data[$key];
            }
        }
        return $result;
    }
}
