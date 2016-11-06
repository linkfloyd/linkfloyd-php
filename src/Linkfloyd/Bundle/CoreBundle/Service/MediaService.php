<?php

namespace Linkfloyd\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Linkfloyd\Bundle\CoreBundle\Entity\Media;

/**
 * @author Guven Atbakan <guven@atbakan.com>
 */
class MediaService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $url
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
     * @return Media
     */
    public function createMedia(string $url) : Media
    {
        $media = new Media();
        $media->setUrl($url);

        $this->entityManager->persist($media);

        return $media;
    }
    /**
     * Creates and inserts media object to database with COMMIT
     *
     * @param string $url
     * @return Media
     */
    public function insertMedia(string $url) : Media
    {
        $media = $this->createMedia($url);

        $this->entityManager->flush();

        return $media;
    }

    /**
     * Returns if a url inserted to Media entity.
     * 
     * @param string $url
     * @return Media|null
     */
    public function getMediaByUrl(string $url)
    {
        return $this->entityManager->getRepository('LinkfloydCoreBundle:Media')
            ->findOneBy(['url'=>$url]);
    }
}
