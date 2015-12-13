<?php

namespace C3P0\Tests\Mocks;

use C3P0\App\Exceptions\InvalidDataException;
use C3P0\App\GithubClient;
use C3P0\App\APIClient;

class GithubClientMock extends GithubClient implements APIClient
{
    private $file_name;

    public function __construct($file_name)
    {
        parent::__construct();
        $this->file_name = $file_name;
    }

    public function getRepositories()
    {
        $repos_json = file_get_contents($this->file_name);
        $repos_array = json_decode($repos_json, true);
        return $repos_array;
    }

    public function setUsername($username)
    {
    }

}
