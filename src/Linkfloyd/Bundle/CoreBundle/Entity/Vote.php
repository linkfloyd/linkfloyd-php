<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */
namespace Linkfloyd\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Vote as BaseVote;
use FOS\CommentBundle\Model\SignedVoteInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Vote extends BaseVote implements SignedVoteInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Comment of this vote.
     *
     * @var Comment
     * @ORM\ManyToOne(targetEntity="Linkfloyd\Bundle\CoreBundle\Entity\Comment")
     */
    protected $comment;

    /**
     * Author of the vote.
     *
     * @ORM\ManyToOne(targetEntity="Linkfloyd\Bundle\UserBundle\Entity\User")
     *
     * @var User
     */
    protected $voter;

    /**
     * Sets the owner of the vote.
     *
     * @param UserInterface $voter
     */
    public function setVoter(UserInterface $voter)
    {
        $this->voter = $voter;
    }

    /**
     * Gets the owner of the vote.
     *
     * @return UserInterface
     */
    public function getVoter()
    {
        return $this->voter;
    }
}
