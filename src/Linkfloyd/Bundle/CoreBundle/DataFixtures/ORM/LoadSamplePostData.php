<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @codeCoverageIgnore
 *
 * Class LoadSamplePostData
 * @package Linkfloyd\Bundle\CoreBundle\DataFixtures\ORM
 * @author Guven Atbakan <guven@atbakan.com>
 */
class LoadSamplePostData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $postService = $this->container->get('linkfloyd.frontend.service.post.create_post_service');
        $urlService = $this->container->get('linkfloyd.frontend.service.url_service');

        $urls = [
            'http://www.acikbilim.com/2015/08/incelemeler/bebeklerin-ahlaki-yasami-paul-bloom.html',
            'http://www.acikbilim.com/2015/08/dosyalar/montana-daglarinda-iz-pesinde-milyar-yillik-mikrofosiller-belt-toplulugu-ve-astrobiyoloji-uzerine.html',
            'http://www.acikbilim.com/2015/08/incelemeler/tum-klinik-deney-verileri-acik-olmali.html',
            'http://www.acikbilim.com/2014/12/gorsel/akciger-kanserine-cok-yakindan-bakis.html',
            'http://www.acikbilim.com/2014/11/gorsel/ayin-fotografi-toprak-ates-hava-su.html',
            'http://www.acikbilim.com/wp-content/uploads/2015/06/sn-resistance-290x166.jpg',
            'http://www.acikbilim.com/2016/10/yayinlar/radyo-programi/mt-14-yuruyen-fosilleriz.html',
            'http://www.acikbilim.com/2014/06/video-gorsel/tedxreset-2014-bilim-yeterince-heyecanlidir.html',
            'http://www.acikbilim.com/2014/04/ceviri/yukselen-sicakliklar-ve-sitma.html',
            'http://www.acikbilim.com/2015/02/duyurular/acik-bilim-v2-karsinizda.html',
        ];
        $faker = Factory::create('tr_TR');
        for ($i = 1; $i <= 100; ++$i) {
            $url = $urls[array_rand($urls)];
            $urlDetails = $urlService->getUrlDetails($url);
            $post = $postService->insertPost(
                $urlDetails,
                $user = $this->getReference('user'),
                $faker->sentence,
                implode("\n\n", $faker->sentences(3))
            );
        }
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 5;
    }
}
