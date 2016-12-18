<?php

namespace Linkfloyd\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Linkfloyd\Bundle\CoreBundle\Entity\Media;

/**
 * Interacts with Media Entity.
 *
 * Class MediaService
 *
 * @author Guven Atbakan <guven@atbakan.com>
 */
class MediaService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * MediaService constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Checks Media Entity by given $url parameter.
     * If not exists, creates new Media object.
     *
     * @param string|null $url
     *
     * @return Media|null
     */
    public function getOrCreateMedia($url)
    {
        if (!$url) {
            return;
        }
        $media = $this->getMediaByUrl($url);
        if (!$media) {
            $media = $this->createMedia($url);
        }

        return $media;
    }

    /**
     * Created media object and persists to database.
     *
     * @param string $url
     *
     * @return Media
     */
    public function createMedia(string $url): Media
    {
        $media = new Media();
        $media->setUrl($url);

        $this->entityManager->persist($media);

        return $media;
    }

    /**
     * Returns Media Entity, if given url exists at Media entity.
     *
     * @param string $url
     *
     * @return Media|null
     */
    public function getMediaByUrl(string $url)
    {
        return $this->entityManager->getRepository('LinkfloydCoreBundle:Media')
            ->findOneBy(['url' => $url]);
    }
}
