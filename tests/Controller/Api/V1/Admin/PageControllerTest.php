<?php

namespace App\Tests\Controller\Api\V1\Admin;

use App\DataFixtures\PageFixtures;
use App\Tests\AbstractControllerTest;

class PageControllerTest extends AbstractControllerTest
{
    public const URL = '/api/v1/pages/';

    protected function setUp(): void
    {
        parent::setUp();

        $this->databaseTool->loadFixtures([PageFixtures::class]);
    }

    public function testIndex()
    {
        $this->client->request('get', self::URL);

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonDocumentMatchesSchema(
            json_decode($this->client->getResponse()->getContent()),
            [
                'data',
                'meta' => [
                    'result_count',
                    'total_pages',
                ],
            ]);
    }

    public function testShow()
    {
        $this->client->request('get', self::URL.'1');

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonDocumentMatchesSchema(
            json_decode($this->client->getResponse()->getContent()),
            [
                'id',
                'name',
                'content',
                'metaTitle',
                'metaDescription',
                'status',
            ]);
    }

    public function testCreate()
    {
        $this->client->request('post', self::URL, [], [], [], json_encode([
            'name' => 'Name',
            'content' => '<p>Content</p>',
            'url' => 'test-url',
            'status' => true,
        ]));

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonDocumentMatchesSchema(
            json_decode($this->client->getResponse()->getContent()),
            [
                'id',
                'name',
                'content',
                'url',
                'status',
            ]
        );
    }

    public function testUpdate()
    {
        $this->client->request('put', self::URL.'1', [], [], [], json_encode([
            'name' => 'Name',
            'content' => '<p>Content</p>',
            'url' => 'test-url',
            'status' => true,
        ]));

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonDocumentMatchesSchema(
            json_decode($this->client->getResponse()->getContent()),
            [
                'id',
                'name',
                'content',
                'url',
                'status',
            ]
        );
    }

    public function testDelete()
    {
        $this->client->request('delete', self::URL.'1');

        $this->assertResponseStatusCodeSame(204);
    }
}
