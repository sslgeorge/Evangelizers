<?php

namespace C3P0\App;

use C3P0\App\Exceptions\InvalidDataException;
use C3P0\App\Exceptions\InvalidMethodException;

class GithubClient implements APIClient
{
    protected $curl_handler;

    protected $username;

    /**
     * Initializes curl, sets the UserAgent to C3P0, this is essential to tell Github that the call is not by a Robot.
     * Sets the API call result to return value rather than display.
     */
    public function __construct()
    {
        //Initializes a new cURL object
        $this->curl_handler = curl_init();
        //Set CURLOPT_USERAGENT to show that human access
        curl_setopt($this->curl_handler, CURLOPT_USERAGENT, 'C3P0');
        //Set CURLOPT_RETURNTRANSFER to ensure that cURL returns the result rather than display it
        curl_setopt($this->curl_handler, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Magic and convinence method to enable call to any property in the returned data.
     *
     * @param mixed $methodName represents the method name when a function that does not exist is called
     * @param mixed $args       arguments passed to the function, in this case it is null
     *
     * @return mixed data return is based on the type of value
     */
    public function __call($methodName, $args)
    {
        //remove first three characters from string and use other part to access array key
        $name = strtolower(substr($methodName, 3, strlen($methodName) - 3));

        //throw exception if value of $name is empty
        if ($name === '' || $name === ' ') {
            throw new InvalidMethodException('You must call a valid method name');
        }

        //Get and return the correpsonding array value with key $name
        $data = $this->get($name);

        return $data;
    }

    /**
     * Function makes the call to the github API, and also converts the return JSON to array.
     *
     * @return array when the JSON has been parsed
     */
    public function getRepositories()
    {
        //set cURL URL to usernames github account
        curl_setopt($this->curl_handler, CURLOPT_URL, 'https://api.github.com/users/'.$this->username.'/repos');
        //run curl_exec to get the information in JSON format
        $repos_json = curl_exec($this->curl_handler);
        //decode the JSON data to ARRAY and return the result
        $repos_array = json_decode($repos_json, true);

        return $repos_array;
    }

    /**
     * Counts the number of available repositories.
     *
     * @return int of the number of respositories
     */
    public function getRepositoriesCount()
    {
        //get and return the number of repositories user has
        //by using count function to count the number of arrays
        return count($this->getRepositories());
    }

    /**
     * Returns the name of repositories returned from API call.
     *
     * @return array of repositories name
     */
    public function getRepositoriesName()
    {
        //Convinence method to get user's repositories name
        return $this->get('name');
    }

    /**
     * Sets the username to make API call to.
     *
     * @param string $username represents username of GITHUB account to make API call to
     */
    public function setUsername($username)
    {
        //Set the username of the user to work with
        $this->username = $username;
    }

    /**
     * Gets a particular field from the returned array of the API call.
     *
     * @param string $key field to return
     *
     * @return mixed of data requested by the $key
     */
    private function get($key)
    {
        //Get all the user's repositories and initialize an empty array
        $repos = $this->getRepositories();
        $result = array();
        //Throw custom exception if $data is not in the proper parseable format
        if (!is_array($repos)) {
            throw new InvalidDataException('Problem loading data, ensure proper format of data');

            return;
        }
        //Loop through each repo return
        foreach ($repos as $data) {
            //If the array is parseable add the value into result array
            if (is_array($data) && array_key_exists($key, $data)) {
                $result[] = $data[$key];
            }
        }

        return $result;
    }
}
