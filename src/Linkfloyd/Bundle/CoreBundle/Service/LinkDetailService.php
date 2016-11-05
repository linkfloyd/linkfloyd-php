<?php

namespace Linkfloyd\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Linkfloyd\Bundle\CoreBundle\Entity\LinkDetail;
use Linkfloyd\Bundle\CoreBundle\Entity\Media;

/**
 * @author Guven Atbakan <guven@atbakan.com>
 */
class LinkDetailService
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
     * Inserts new LinkDetail
     *
     * @param string $url
     * @param string|null $title
     * @param string|null $description
     * @param Media|null $thumbnailMedia
     *
     * @return LinkDetail
     */
    public function insertLinkDetail(string $url, $title, $description, Media $thumbnailMedia = null) : LinkDetail
    {
        $link = new LinkDetail();
        $link->setUrl($url)
            ->setTitle($title)
            ->setDescription($description)
            ->setThumbnailMedia($thumbnailMedia);

        $this->entityManager->persist($link);
        $this->entityManager->flush();

        return $link;
    }
}
