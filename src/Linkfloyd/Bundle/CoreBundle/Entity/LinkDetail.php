<?php
namespace Linkfloyd\Bundle\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="link_details", indexes={@ORM\Index(name="thumbnail_media_id_index", columns={"thumbnail_media_id"})})
 */
class LinkDetail
{
    /**
     * adds created_at, updated_at columns
     */
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=140, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @var \Media|null
     *
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="thumbnail_media_id", referencedColumnName="id")
     */
    private $thumbnailMedia;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return LinkDetail
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return LinkDetail
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return LinkDetail
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set thumbnailMedia
     *
     * @param \Linkfloyd\Bundle\CoreBundle\Entity\Media $thumbnailMedia
     *
     * @return LinkDetail
     */
    public function setThumbnailMedia(\Linkfloyd\Bundle\CoreBundle\Entity\Media $thumbnailMedia = null)
    {
        $this->thumbnailMedia = $thumbnailMedia;

        return $this;
    }

    /**
     * Get thumbnailMedia
     *
     * @return \Linkfloyd\Bundle\CoreBundle\Entity\Media
     */
    public function getThumbnailMedia()
    {
        return $this->thumbnailMedia;
    }
}
