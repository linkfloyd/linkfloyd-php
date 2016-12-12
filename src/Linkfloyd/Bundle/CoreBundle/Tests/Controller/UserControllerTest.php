<?php

namespace Linkfloyd\Bundle\CoreBundle\Tests\Controller;

use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testUserRegister()
    {
        $client = static::createClient();
        /** @var ContainerInterface $container */
        $container = $client->getContainer();
        $csrfToken = $container->get('security.csrf.token_manager')->getToken('registration');
        $faker = Factory::create();

        $password = $faker->password;
        $parameters = [
            'fos_user_registration_form' => [
                '_token'        => $csrfToken,
                'username'      => $faker->userName,
                'email'         => $faker->email,
                'plainPassword' => [
                    'first'  => $password,
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
        $client = static::createClient();

        $crawler = $client->request('GET', '/logout');
        /* shoudl redirect, bcs there is no logged user */
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
