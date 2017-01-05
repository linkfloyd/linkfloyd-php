<?php

namespace Linkfloyd\Bundle\CoreBundle\EventListener;

use FOS\CommentBundle\Event\CommentEvent;
use FOS\CommentBundle\Events;
use Linkfloyd\Bundle\CoreBundle\Entity\Comment;
use Linkfloyd\Bundle\CoreBundle\Service\PostService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostCommentCountListener implements EventSubscriberInterface
{
    /**
     * @var PostService
     */
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public static function getSubscribedEvents()
    {
        return [
            Events::COMMENT_POST_PERSIST => 'onCommentPostPersist',
        ];
    }

    /**
     * https://github.com/FriendsOfSymfony/FOSCommentBundle/blob/master/Resources/doc/15-events.md.
     *
     * @param CommentEvent $event
     */
    public function onCommentPostPersist(CommentEvent $event)
    {
        /** @var Comment $comment */
        $comment = $event->getComment();

        $threadId = $comment->getThread()->getId();

        $postId = explode('_', $threadId)[1];
        $post = $this->postService->getPost($postId);
        if ($post) {
            $this->postService->increaseCommentCount($post);
        }
    }
}
