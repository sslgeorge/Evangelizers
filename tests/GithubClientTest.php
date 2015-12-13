<?php
namespace C3P0\Tests;

use C3P0\Tests\Mocks\GithubClientMock;

class GithubClientTest extends \PHPUnit_Framework_TestCase
{
    protected $client1;
    protected $client2;

    public function setUp()
    {
        $this->client1 = new GithubClientMock(__DIR__."/Mocks/andela-gjames.json");
        $this->client2 = new GithubClientMock(__DIR__."/Mocks/laravel.json");
    }

    public function testGetRepositoriesReturnType()
    {
        $client1 = $this->client1;
        $client2 = $this->client2;
        $this->assertInternalType('array', $client1->getRepositories(), 'Return type should be an array');
        $this->assertInternalType('array', $client2->getRepositories(), 'Return type should be an array');
    }

    public function testGetRepositoriesCount()
    {
        $client1 = $this->client1;
        $client2 = $this->client2;
        $this->assertSame(4, $client1->getRepositoriesCount(), "Should return the correct amount of repositories");
        $this->assertSame(20, $client2->getRepositoriesCount(), "Should return the correct amount of repositories");
    }

    public function testGetRepositoriesName()
    {
        $names1 = $this->client1->getName();
        $names2 = $this->client2->getName();

        $this->assertSame('emoji-cheat-sheet.com', $names1[0]);
        $this->assertSame('Urban-Dictionary', $names1[3]);

        $this->assertSame('art', $names2[0]);
        $this->assertSame('socialite', $names2[17]);
    }
}
