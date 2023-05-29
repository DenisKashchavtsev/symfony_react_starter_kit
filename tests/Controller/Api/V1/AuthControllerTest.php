<?php

namespace App\Tests\Controller\Api\V1;

use App\DataFixtures\UserFixtures;
use App\Tests\AbstractControllerTest;
use Doctrine\ORM\NonUniqueResultException;

class AuthControllerTest extends AbstractControllerTest
{
    public const URL = '/api/v1/auth/';

    public function testLogin()
    {
        $this->client->request(
            'POST',
            '/api/v1/auth/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['username' => 'demo@demo.com', 'password' => 'demo1234'])
        );

        $this->assertJsonDocumentMatchesSchema(json_decode($this->client->getResponse()->getContent()), ['token']);

        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function testSignUp()
    {
        $this->client->request('post', self::URL.'signUp', [], [], ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'firstName' => 'FirstName',
                'lastName' => 'LastName',
                'email' => 'signUp@demo.com',
                'password' => 'demo1234',
                'confirmPassword' => 'demo1234',
            ]));

        $this->assertJsonDocumentMatchesSchema(json_decode($this->client->getResponse()->getContent()), ['token']);

        $this->assertResponseStatusCodeSame(200);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->databaseTool->loadFixtures([UserFixtures::class]);
    }
}
