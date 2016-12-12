<?php

namespace Linkfloyd\Bundle\CoreBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class BaseTestCase extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    protected function getClient()
    {
        return static::createClient();
    }

    protected function getLoggedInClient()
    {
        $session = $this->client->getContainer()->get('session');

        // the firewall context (defaults to the firewall name)
        $firewall = 'main_firewall';

        $token = new UsernamePasswordToken('admin', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);

        $crawler = $this->client->request('GET', '/posts/insert');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        return $this->client;
    }
}
