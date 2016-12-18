<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Linkfloyd\Bundle\UserBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="Linkfloyd\Bundle\CoreBundle\Repository\PostRepository")
 * @ORM\Table(name="posts", indexes={@ORM\Index(name="link_detail_id_index", columns={"link_detail_id"}),@ORM\Index(name="user_id_index", columns={"user_id"})})
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Post
{
    /*
     * adds created_at, updated_at, deleted_at columns
     */
    use SoftDeleteableEntity, TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Linkfloyd\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var LinkDetail|null
     *
     * @ORM\ManyToOne(targetEntity="Linkfloyd\Bundle\CoreBundle\Entity\LinkDetail")
     * @ORM\JoinColumn(name="link_detail_id", referencedColumnName="id", nullable=true)
     */
    private $linkDetail;

    /**
     * @ORM\OneToOne(targetEntity="Linkfloyd\Bundle\CoreBundle\Entity\PostDetail", mappedBy="post")
     */
    private $detail;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user.
     *
     * @param \Linkfloyd\Bundle\UserBundle\Entity\User $user
     *
     * @return Post
     */
    public function setUser(\Linkfloyd\Bundle\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Linkfloyd\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set linkDetail.
     *
     * @param \Linkfloyd\Bundle\CoreBundle\Entity\LinkDetail $linkDetail
     *
     * @return Post
     */
    public function setLinkDetail(\Linkfloyd\Bundle\CoreBundle\Entity\LinkDetail $linkDetail = null)
    {
        $this->linkDetail = $linkDetail;

        return $this;
    }

    /**
     * Get linkDetail.
     *
     * @return \Linkfloyd\Bundle\CoreBundle\Entity\LinkDetail
     */
    public function getLinkDetail()
    {
        return $this->linkDetail;
    }

    /**
     * Set detail.
     *
     * @param \Linkfloyd\Bundle\CoreBundle\Entity\PostDetail $detail
     *
     * @return Post
     */
    public function setDetail(\Linkfloyd\Bundle\CoreBundle\Entity\PostDetail $detail = null)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail.
     *
     * @return \Linkfloyd\Bundle\CoreBundle\Entity\PostDetail
     */
    public function getDetail()
    {
        return $this->detail;
    }

    public function isAuthor(UserInterface $user = null)
    {
        return $user && $user->getId() === $this->getUser()->getId();
    }
}
