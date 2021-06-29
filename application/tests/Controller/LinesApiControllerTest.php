<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\LinesRepository;


class LinesApiControllerTest extends WebTestCase
{
    public function testLoggedWithAdminIndex(): void
    {

        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['username' => 'Admin']);

        $client->loginUser($testUser);

        $client->request('GET', '/api/lines');
        $this->assertResponseIsSuccessful();

    }

    public function testLoggedWithUserIndex(): void
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['username' => 'Lola']);

        $client->loginUser($testUser);

        $client->request('GET', 'api/lines');

        $this->assertResponseIsSuccessful();
    }

    public function testNotLoggedInIndex(): void
    {
        $client = static::createClient();

        $client->request('GET', 'api/lines');
        $this->assertResponseStatusCodeSame(302);
    }

    public function testShow():void
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $linesRepository = static::$container->get(LinesRepository::class);

        $line = $linesRepository->findOneBy([]);
        $lineId = $line->getId();

        $testUser = $userRepository->findOneBy(['username' => 'Admin']);
        $client->loginUser($testUser);

        $client->request('GET', 'api/lines/'. $lineId);
        $this->assertResponseIsSuccessful();

        $jsonResponse = json_decode($client->getResponse()->getContent());
        $this->assertEquals($lineId, $jsonResponse->id);
    }

    public function testCreate(): void
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneBy(['username' => 'Admin']);
        $client->loginUser($testUser);
        $client->request('POST', 'api/lines', [], [], ['Content-Type' => 'application/json'], '{"name": "Pully", "difficulties":[{"name": "Difficile"}], "feedbacks": []}');

        $client->getResponse();
        $this->assertResponseIsSuccessful();

        $linesRepository = static::$container->get(LinesRepository::class);
        $createdLineName = $linesRepository->findOneBy(['name'=> 'Pully'])->getName();

        $this->assertSame('Pully', $createdLineName);
    }

    public function testUpdate():void
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $linesRepository = static::$container->get(LinesRepository::class);

        $line = $linesRepository->findOneBy([]);
        $lineId = $line->getId();

        $testUser = $userRepository->findOneBy(['username' => 'Admin']);
        $client->loginUser($testUser);
        $client->request('PUT', 'api/lines/'. $lineId, [], [], ['Content-Type' => 'application/json'], '{"name": "TEST", "difficulties":[{"name": "Difficile"}], "feedbacks": []}');

        $this->assertResponseIsSuccessful();
        $this->assertSame('TEST', $line->getName());
    }

    public function testRemove():void
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $linesRepository = static::$container->get(LinesRepository::class);

        $line = $linesRepository->findOneBy([]);
        $lineId = $line->getId();

        $testUser = $userRepository->findOneBy(['username' => 'Admin']);
        $client->loginUser($testUser);
        $client->request('DELETE', 'api/lines/'. $lineId);

        $this->assertResponseIsSuccessful();
    }
}