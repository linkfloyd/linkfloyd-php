<?php

namespace Linkfloyd\Bundle\CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/posts');
    }

    public function testInsertpost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/posts/insert');
    }

}
