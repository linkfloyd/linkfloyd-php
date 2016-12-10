<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\UserBundle\Manager;

use FOS\UserBundle\Model\UserManagerInterface;
use Linkfloyd\Bundle\UserBundle\Entity\User;
use Linkfloyd\Bundle\UserBundle\Event\UserEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UserManager
{
    /**
     * @var UserManagerInterface
     */
    private $userManager;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        UserManagerInterface $userManager,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->userManager = $userManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createUser(
        string $email,
        string $username,
        string $password
    ): User {
        $user = $this->userManager->createUser();
        $user->setEmail($email)
            ->setPlainPassword($password)
            ->setUsername($username)
            ->setEnabled(true)
            ->addRole(User::ROLE_DEFAULT);
        $this->userManager->updateUser($user);

        $this->eventDispatcher->dispatch(
            UserEvent::EVENT_NAME_CREATED,
            new UserEvent($user)
        );

        return $user;
    }
}
