<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\Service\Post;

use Doctrine\ORM\EntityManagerInterface;
use Linkfloyd\Bundle\CoreBundle\Entity\Post;
use Linkfloyd\Bundle\CoreBundle\Service\LinkDetailService;
use Linkfloyd\Bundle\CoreBundle\Service\MediaService;
use Linkfloyd\Bundle\CoreBundle\Service\PostService;
use Symfony\Component\Security\Core\User\UserInterface;

class CreatePostService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var MediaService
     */
    private $mediaService;
    /**
     * @var LinkDetailService
     */
    private $linkDetailService;
    /**
     * @var PostService
     */
    private $postService;

    public function __construct(
        EntityManagerInterface $entityManager,
        MediaService $mediaService,
        LinkDetailService $linkDetailService,
        PostService $postService
    ) {
        $this->entityManager = $entityManager;
        $this->mediaService = $mediaService;
        $this->linkDetailService = $linkDetailService;
        $this->postService = $postService;
    }

    public function insertPost(array $urlDetails, UserInterface $user, $title, $description): Post
    {
        $media = $this->mediaService->getOrCreateMedia(@$urlDetails['thumbnail_url']);
        $linkDetail = $this->linkDetailService->getOrCreateLinkDetail($urlDetails['url'], @$urlDetails['title'], @$urlDetails['description'], $media);
        $post = $this->postService->insertPost($user, $linkDetail, $title, $description);

        return $post;
    }
}
