<?php

namespace CMS2\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Alias
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Alias
{
    const Page = '1';
    const BlogPost = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"alias"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     * @Groups({"alias"})
     */
    private $url;

    /**
     * @var integer
     *
     * Type 1 - page
     * Type 2 - blogPost
     * @ORM\Column(name="type", type="integer")
     * @Groups({"alias"})
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="BlogPost", mappedBy="alias", fetch="EAGER")
     */
    private $blogpost;

    /**
     *
     * @var type
     * @Groups({"alias"})
     */
    private $blogPostId;

    /**
     * @ORM\OneToOne(targetEntity="Page", mappedBy="alias", fetch="EAGER")
     */
    private $page;

    /**
     *
     * @var type
     * @Groups({"alias"})
     */
    private $pageid;

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
     * @return Alias
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
     * Set type
     *
     * @param string $type
     * @return Type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set blogpost
     *
     * @param CMS2\BaseBundle\Entity\BlogPost $blogpost
     * @return CMS2\BaseBundle\Entity\BlogPost
     */
    public function setBlogpost($blogpost)
    {
        $this->blogpost = $blogpost;

        return $this;
    }

    /**
     * Get blogpost
     *
     * @return CMS2\BaseBundle\Entity\BlogPost
     */
    public function getBlogpost()
    {
        return $this->blogpost;
    }

    /**
     * Set page
     *
     * @param CMS2\BaseBundle\Entity\Page $page
     * @return CMS2\BaseBundle\Entity\Page
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return CMS2\BaseBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /*
     * This method is needed for EasyAdmin Bundle to return correctly the values
     * to the forms
     */

    public function __toString()
    {
        return $this->url;
    }

    /**
     * This method will return the Space of the url alias, if page or Blog post
     *
     * @return string
     */
    public function getSpace()
    {
        if ($this->getId() == self::Page) {
            return 'Page';
        } else {
            return 'Blog Post';
        }
    }

    public function getBlogPostId()
    {
        if ($this->getBlogpost() != null) {
            return $this->getBlogpost()->getId();
        }
    }

    public function getPageid()
    {
        if ($this->getPage() != null) {
            return $this->getPage()->getId();
        }
    }
}
