<?php

namespace Linkfloyd\Bundle\CoreBundle\Security;

use Linkfloyd\Bundle\CoreBundle\Entity\Post;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PostVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed  $subject   The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        if (!$subject instanceof Post) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string         $attribute
     * @param Post           $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        switch ($attribute) {
            case self::DELETE:
            case self::EDIT:
                return $subject->isAuthor($user);
        }

        return false;
    }
}
