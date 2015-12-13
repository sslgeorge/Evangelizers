<?php
namespace C3P0\Tests;

use C3P0\Tests\Mocks\GithubClientMock;
use C3P0\App\EvangelistStatus;

class EvangelistStatusTest extends \PHPUnit_Framework_TestCase
{
    private $evangelist1;
    public function setUp()
    {
        $client1 = new GithubClientMock(__DIR__."/Mocks/laravel.json");
        $client2 = new GithubClientMock(__DIR__."/Mocks/andela-gjames.json");

        $this->evangelist1 = new EvangelistStatus('laravel', $client1);
        $this->evangelist2 = new EvangelistStatus('laravel', $client2);
    }

    public function testGetStatus()
    {
        $this->assertSame(
            'Associate Evangelist: You have come far, but your journey is not yet near end, fight harder',
            $this->evangelist1->getStatus(),
            "Should return the same text for associative"
        );

        $this->assertSame(
            "You have no place yet on the aisle where Legends of debugging stand, fight brave and harder",
            $this->evangelist2->getStatus(),
            "Should return the same text for associative"
        );
    }
}
