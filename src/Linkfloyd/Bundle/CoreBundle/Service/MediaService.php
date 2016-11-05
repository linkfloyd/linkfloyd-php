<?php

namespace Linkfloyd\Bundle\CoreBundle\Service;

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
     * TODO:
     *
     * @param string $url
     * @return Media
     */
    public function insertMedia(string $url) : Media
    {
        $media = new Media();
        $media->setUrl($url);

        $this->entityManager->persist($url);
        $this->entityManager->flush();

        return $media;
    }
}
