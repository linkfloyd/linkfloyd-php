<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */
namespace Linkfloyd\Bundle\CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Api Documentation', $client->getResponse()->getContent());
    }
}
