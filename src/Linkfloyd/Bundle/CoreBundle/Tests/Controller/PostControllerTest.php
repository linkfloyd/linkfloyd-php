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
     * User cannot see post link page and should redirected to login page.
     */
    public function testGetInsertPostPageWithoutLoggedInUser()
    {
        $client = $this->getClient();

        $crawler = $client->request('GET', '/posts/insert');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertContains('/login', $client->getResponse()->getContent());
    }

    /**
     * User cannot POST anything if not logged in.
     */
    public function testPostInsertPostPageWithoutLoggedInUser()
    {
        $client = $this->getClient();

        $crawler = $client->request('POST', '/posts/insert');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertContains('/login', $client->getResponse()->getContent());
    }

    /**
     * User can see post link page.
     */
    public function testGetInsertPostPageWithLoggedInUser()
    {
        $client = $this->getLoggedInClient();

        $crawler = $client->request('GET', '/posts/insert');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //contains url input
        $this->assertContains('[url]', $client->getResponse()->getContent());
        //contains title input
        $this->assertContains('[title]', $client->getResponse()->getContent());
        //contains submit button
        $this->assertContains('[submit]', $client->getResponse()->getContent());
    }

    /**
     * User should post something.
     */
    public function testPostPostWithLoggedInUser()
    {
        $client = $this->getLoggedInClient();

        $crawler = $client->request('GET', '/posts/insert');
        $buttonCrawlerNode = $crawler->selectButton('Submit');
        $form = $buttonCrawlerNode->form();

        $crawler = $client->submit($form);
        $this->assertContains('has-error', $client->getResponse()->getContent()); //check per spesific errors

        $form['insert_post_form[title]'] = 'Title';
        $form['insert_post_form[url]'] = 'http://yalansavar.org';
        $crawler = $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());


        //let add same link again (for coverage sake)

        $form['insert_post_form[title]'] = 'Title';
        $form['insert_post_form[url]'] = 'http://yalansavar.org';
        $crawler = $client->submit($form);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

    }
}
