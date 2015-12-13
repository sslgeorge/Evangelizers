<?php

namespace C3P0\App;

use C3P0\App\Exceptions\InvalidDataException;
class GithubClient implements APIClient
{
    protected $curl_handler;

    protected $username;


    public function __construct()
    {
        //Initializes a new cURL object
        $this->curl_handler = curl_init();
        //Set CURLOPT_USERAGENT to show that human access
        curl_setopt($this->curl_handler, CURLOPT_USERAGENT, 'C3P0');
        //Set CURLOPT_RETURNTRANSFER to ensure that cURL returns the result rather than display it
        curl_setopt($this->curl_handler, CURLOPT_RETURNTRANSFER, true);
    }

    public function __call($methodName, $args)
    {
        //remove first three characters from string and use other part to access array key
        $name = strtolower(substr($methodName, 3, strlen($methodName)-3));

        //throw exception if value of $name is empty
        if ($name == '' || $name == " ") {
            throw new \InvalidMethodException("You must call a valid method name");
        }

        //Get and return the correpsonding array value with key $name
        $data = $this->get($name);
        return $data;
    }

    public function getRepositories()
    {
        //set cURL URL to usernames github account
        curl_setopt($this->curl_handler, CURLOPT_URL, "https://api.github.com/users/".$this->username."/repos");
        //run curl_exec to get the information in JSON format
        $repos_json = curl_exec($this->curl_handler);
        //decode the JSON data to ARRAY and return the result
        $repos_array = json_decode($repos_json, true);
        return $repos_array;
    }


    public function getRepositoriesCount()
    {
        //get and return the number of repositories user has
        //by using count function to count the number of arrays
        return count($this->getRepositories());
    }

    public function getRepositoriesName()
    {
        //Convinence method to get user's repositories name
        return $this->get('name');
    }

    public function setUsername($username)
    {
        //Set the username of the user to work with
        $this->username = $username;
    }

    private function get($key)
    {
        //Get all the user's repositories and initialize an empty array
        $repos = $this->getRepositories();
        $result = [];

        //Loop through each repo return
        foreach ($repos as $data) {
            //Throw custom exception if $data is not in the proper parseable format
            if (!is_array($data)) {
                throw new InvalidDataException("Problem loading data, ensure proper format of data");
            }
            //If the array is parseable add the value into result array
            if (array_key_exists($key, $data)) {
                $result[] = $data[$key];
            }
        }
        return $result;
    }
}
