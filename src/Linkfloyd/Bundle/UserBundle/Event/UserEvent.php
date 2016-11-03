<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\UserBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Linkfloyd\Bundle\UserBundle\Entity\User;

class UserEvent extends Event
{
    const EVENT_NAME_CREATED = 'linkfloyd.user_bundle.event.user_created_event';
    const EVENT_NAME_UPDATED = 'linkfloyd.user_bundle.event.user_updated_event';

    /**
     * @var User
     */
    private $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
