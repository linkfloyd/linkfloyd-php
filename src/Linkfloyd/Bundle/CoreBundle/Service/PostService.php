<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Linkfloyd\Bundle\CoreBundle\Entity\LinkDetail;
use Linkfloyd\Bundle\CoreBundle\Entity\Post;
use Linkfloyd\Bundle\CoreBundle\Entity\PostDetail;
use Linkfloyd\Bundle\UserBundle\Entity\User;

class PostService
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
     * @param User $user
     * @param LinkDetail $linkDetail
     * @param string $title
     * @param string|null $description
     * @return Post
     */
    public function insertPost(User $user, LinkDetail $linkDetail, string $title, $description) : Post
    {
        $post = new Post();
        $post->setUser($user)
            ->setLinkDetail($linkDetail);

        $this->entityManager->persist($post);

        $postDetail = new PostDetail();
        $postDetail->setPost($post)
            ->setTitle($title)
            ->setDescription($description);

        $this->entityManager->persist($postDetail);
        $this->entityManager->flush();

        return $post;
    }
}
