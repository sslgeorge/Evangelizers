<?php
namespace C3P0\Tests;

use C3P0\Tests\Mocks\GithubClientMock;
use C3P0\App\EvangelistStatus;

class EvangelistStatusTest extends \PHPUnit_Framework_TestCase
{
    private $babyEvangelist;
    private $juniorEvangelist;
    private $associateEvangelist;
    private $seniorEvangelist;
    public function setUp()
    {
        $babyEvangelist         = new GithubClientMock(__DIR__."/Mocks/Fixtures/andela-gjames.json");
        $juniorEvangelist       = new GithubClientMock(__DIR__."/Mocks/Fixtures/juniordeveloper.json");
        $associateGithubClient  = new GithubClientMock(__DIR__."/Mocks/Fixtures/laravel.json");
        $seniorGithubClient     = new GithubClientMock(__DIR__."/Mocks/Fixtures/unicodevloper.json");

        $this->babyEvangelist       = new EvangelistStatus('andela-gjames', $babyEvangelist);
        $this->juniorEvangelist     = new EvangelistStatus('juniordeveloper', $juniorEvangelist);
        $this->associateEvangelist  = new EvangelistStatus('laravel', $associateGithubClient);
        $this->seniorEvangelist     = new EvangelistStatus('unicodevloper', $seniorGithubClient);
    }

    public function testBabyEvangelist()
    {
        $this->assertSame(
            "You have no place yet on the aisle where Legends of debugging stand, fight brave and harder",
            $this->babyEvangelist->getStatus(),
            "Should return the same text for newbie"
        );
    }

    public function testJuniorEvangelist()
    {
        $this->assertSame(
            "Junior Evangelist: Real knowledge is to know the extent of one's ignorance",
            $this->juniorEvangelist->getStatus(),
            "Should return the same text for Junior Evangelist"
        );
    }

    public function testAssociateEvangelist()
    {
        $this->assertSame(
            'Associate Evangelist: You have come far, but your journey is not yet near end, fight harder',
            $this->associateEvangelist->getStatus(),
            "Should return the same text for associate"
        );
    }

    public function testSeniorEvangelist()
    {
        $this->assertSame(
            'Senior Evangelist: Coffee price increased because of you, mighty and powerful :(',
            $this->seniorEvangelist->getStatus(),
            "Should return the same text for senior"
        );
    }
}
