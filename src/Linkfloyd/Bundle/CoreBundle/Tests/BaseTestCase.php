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

    /**
     * @return \Symfony\Bundle\FrameworkBundle\Client|void
     */
    protected function getLoggedInClient()
    {
        $client = static::createClient();
        $session = $client->getContainer()->get('session');

        // the firewall context (defaults to the firewall name)
        $firewall = 'main';

        $user = $client->getContainer()->get('fos_user.user_manager')
            ->findUserByUsername('admin');
        $token = new UsernamePasswordToken($user, null, $firewall, array('ROLE_USER'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        return $client;
    }
}
