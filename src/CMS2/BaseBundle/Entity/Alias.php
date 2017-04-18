<?php

namespace CMS2\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alias
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Alias
{
    const page = '1';
    const blogPost = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @var integer
     *
     * Type 1 - page
     * Type 2 - blogPost
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

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
        if ($this->getId() == self::page) {
            return 'Page';
        } else {
            return 'Blog Post';
        }
    }
}
