<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class IndexControllerTest extends WebTestCase
{

    private KernelBrowser|null $client = null;
    private $userRepository;
    private $userTest;
    private $urlGenerator;

    public function setUp() : void
    {
        $this->client = static::createClient();

        $this->userRepository = $this->client->getContainer()->get('doctrine.orm.entity_manager')->getRepository(User::class);

        $this->userTest = $this->userRepository->findOneById('1');

        $this->urlGenerator = $this->client->getContainer()->get('router.default');

        $this->client->loginUser($this->userTest);
    }

    public function testIndex()
    {

        $crawler = $this->client->request(Request::METHOD_GET, $this->urlGenerator->generate('app_home'));

        $this->assertSame(1, $crawler->filter('html:contains("Ouverture: de 8H à 22H")')->count());

    }
}