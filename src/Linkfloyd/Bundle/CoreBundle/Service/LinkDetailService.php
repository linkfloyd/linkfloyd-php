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
    public function getOrCreateLinkDetail(string $url, $title, $description, Media $thumbnailMedia = null) : LinkDetail
    {
        $linkDetail = $this->getLinkDetailByUrl($url);
        if (!$linkDetail) {
            $linkDetail = $this->createLinkDetail($url, $title, $description, $thumbnailMedia);
        }

        return $linkDetail;
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
    public function createLinkDetail(string $url, $title, $description, Media $thumbnailMedia = null) : LinkDetail
    {
        $link = new LinkDetail();
        $link->setUrl($url)
            ->setTitle($title)
            ->setDescription($description)
            ->setThumbnailMedia($thumbnailMedia);

        $this->entityManager->persist($link);

        return $link;
    }

    /**
     * Creates and inserts LinkDetail object to database
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
        $link = $this->createLinkDetail($url, $title, $description, $thumbnailMedia);
        $this->entityManager->flush();

        return $link;
    }

    /**
     * Returns if a given url added to LinkDetail entity.
     *
     * @param string $url
     * @return LinkDetail|null
     */
    public function getLinkDetailByUrl(string $url)
    {
        return $this->entityManager->getRepository('LinkfloydCoreBundle:LinkDetail')
            ->findOneBy(['url'=>$url]);
    }
}
