<?php

namespace Linkfloyd\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Linkfloyd\Bundle\CoreBundle\Entity\PostDetail;

class PostDetailService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updatePostDetail(PostDetail $postDetail, $title) :PostDetail
    {
        $postDetail->setTitle($title);
        $this->entityManager->persist($postDetail);
        $this->entityManager->flush();

        return $postDetail;
    }
}
