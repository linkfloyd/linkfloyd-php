<?php

namespace Linkfloyd\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Linkfloyd\Bundle\CoreBundle\Entity\PostDetail;

/**
 * Interacts with PostDetail Entity.
 *
 * Class PostDetailService
 *
 * @author Guven Atbakan <guven@atbakan.com>
 */
class PostDetailService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * PostDetailService constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Updates PostDetail object.
     *
     * @param PostDetail $postDetail
     * @param string     $title
     *
     * @return PostDetail
     */
    public function updatePostDetail(PostDetail $postDetail, string $title): PostDetail
    {
        $postDetail->setTitle($title);
        $this->entityManager->persist($postDetail);
        $this->entityManager->flush();

        return $postDetail;
    }
}
