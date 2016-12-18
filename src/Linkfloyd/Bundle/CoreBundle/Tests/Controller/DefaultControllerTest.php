<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\Tests\Controller;

use Linkfloyd\Bundle\CoreBundle\Tests\BaseTestCase;

class DefaultControllerTest extends BaseTestCase
{
    public function testIndex()
    {
        $client = $this->getClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        /* There is always a link to API  Documentation*/
        $this->assertContains('Api Documentation', $client->getResponse()->getContent());
    }
}
