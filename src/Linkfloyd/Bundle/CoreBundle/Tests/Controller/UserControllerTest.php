<?php

namespace Linkfloyd\Bundle\CoreBundle\Tests\Controller;

use Faker\Factory;
use Linkfloyd\Bundle\CoreBundle\Tests\BaseTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserControllerTest extends BaseTestCase
{
    public function testLogin()
    {
        $client = $this->getClient();

        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testRegister()
    {
        $client = $this->getClient();

        $crawler = $client->request('GET', '/register/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testUserRegister()
    {
        $client = $this->getClient();
        /** @var ContainerInterface $container */
        $container = $client->getContainer();
        $csrfToken = $container->get('security.csrf.token_manager')->getToken('registration');
        $faker = Factory::create();

        $password = $faker->password;
        $parameters = [
            'fos_user_registration_form' => [
                '_token' => $csrfToken,
                'username' => $faker->userName,
                'email' => $faker->email,
                'plainPassword' => [
                    'first' => $password,
                    'second' => $password,
                ],
            ],
        ];

        $crawler = $client->request('POST', '/register/', $parameters);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertContains('/register/confirmed', $client->getResponse()->getContent());
    }

    public function testLogout()
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/logout');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $client = $this->getLoggedInClient();
        $crawler = $client->request('GET', '/logout');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        //todo check there is no logged in user
    }
}
