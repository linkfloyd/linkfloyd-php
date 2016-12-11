<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Linkfloyd\Bundle\CoreBundle\Entity\LinkDetail;
use Linkfloyd\Bundle\CoreBundle\Entity\Post;
use Linkfloyd\Bundle\CoreBundle\Entity\PostDetail;
use Linkfloyd\Bundle\CoreBundle\Event\PostCreatedEvent;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class PostService.
 *
 * @author Guven Atbakan <guven@atbakan.com>
 */
class PostService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * PostService constructor.
     *
     * @param EntityManagerInterface   $entityManager
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param int $id
     *
     * @return Post|null
     */
    public function getPost(int $id)
    {
        return $this->entityManager->getRepository('LinkfloydCoreBundle:Post')
            ->find($id);
    }

    /**
     * @param int $page
     * @param int $limit
     *
     * @return Pagerfanta
     */
    public function getPosts($page, $limit)
    {
        $posts = $this->entityManager->getRepository('LinkfloydCoreBundle:Post')
            ->findPosts();
        $adapter = new DoctrineORMAdapter($posts);
        $pagerfanta = new Pagerfanta($adapter);

        try {
            $pagerfanta->setCurrentPage($page)
                ->setMaxPerPage($limit);
        } catch (\Exception $e) {
            return;
        }

        return $pagerfanta;
    }

    /**
     * @param UserInterface $user
     * @param LinkDetail    $linkDetail
     * @param string        $title
     * @param string|null   $description
     *
     * @return Post
     */
    public function insertPost(UserInterface $user, LinkDetail $linkDetail, string $title, $description): Post
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

        $this->eventDispatcher->dispatch(
            PostCreatedEvent::EVENT_NAME,
            new PostCreatedEvent($post)
        );

        return $post;
    }

    public function deletePost(Post $post)
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}
