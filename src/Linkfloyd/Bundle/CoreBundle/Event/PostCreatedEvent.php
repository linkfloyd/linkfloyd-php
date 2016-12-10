<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\Event;

use Linkfloyd\Bundle\CoreBundle\Entity\Post;
use Symfony\Component\EventDispatcher\Event;

class PostCreatedEvent extends Event
{
    const EVENT_NAME = 'linkfloyd_core_bundle.event.post_created_event';
    /**
     * @var Post
     */
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }
}
