<?php
namespace C3P0\App;

interface APIClient
{
    public function __call($methodname, $arguments);
    public function getRepositories();
    public function getRepositoriesCount();
    public function getRepositoriesName();
    public function setUsername($username);
}
