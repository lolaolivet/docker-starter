<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\LinesRepository;
use App\Repository\Lines;


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
        $line_id = $line->getId();

        $testUser = $userRepository->findOneBy(['username' => 'Admin']);
        $client->loginUser($testUser);

        $client->request('GET', 'api/lines/'. $line_id);
        $this->assertResponseIsSuccessful();

        $jsonResponse = json_decode($client->getResponse()->getContent());
        $this->assertEquals($line_id, $jsonResponse->id);
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
        $created_line_name = $linesRepository->findOneBy(['name'=> 'Pully'])->getName();

        $this->assertSame('Pully', $created_line_name);
    }

    public function testUpdate():void
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $linesRepository = static::$container->get(LinesRepository::class);

        $line = $linesRepository->findOneBy([]);
        $line_id = $line->getId();

        $testUser = $userRepository->findOneBy(['username' => 'Admin']);
        $client->loginUser($testUser);
        $client->request('PUT', 'api/lines/'. $line_id, [], [], ['Content-Type' => 'application/json'], '{"name": "TEST", "difficulties":[{"name": "Difficile"}], "feedbacks": []}');

        $this->assertResponseIsSuccessful();
        $this->assertSame('TEST', $line->getName());
    }
}