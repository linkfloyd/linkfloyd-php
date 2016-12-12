<?php

namespace Linkfloyd\Bundle\CoreBundle\Tests\Controller;

use Linkfloyd\Bundle\CoreBundle\Tests\BaseTestCase;

class PostControllerTest extends BaseTestCase
{
    public function testIndex()
    {
        $client = $this->getClient();

        $crawler = $client->request('GET', '/posts');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * User can see post link page.
     */
    /*public function testInsertPostWithLoggedInUser()
    {
        $client = $this->getLoggedInClient();

        $crawler = $client->request('GET', '/posts/insert');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }*/

    /**
     * User cannot see post link page.
     */
    public function testInsertPostWithoutLoggedInUser()
    {
        $client = $this->getClient();

        $crawler = $client->request('GET', '/posts/insert');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertContains('/login', $client->getResponse()->getContent());
    }
}
