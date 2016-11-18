<?php

namespace Linkfloyd\Bundle\CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/posts');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testInsertpost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/posts/insert');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
