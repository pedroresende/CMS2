<?php

namespace CMS2\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * BlogPost
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BlogPost
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"blogpost"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Groups({"blogpost"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     * @Groups({"blogpost"})
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     * @Groups({"blogpost"})
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     * @Groups({"blogpost"})
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Groups({"blogpost"})
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255)
     * @Groups({"blogpost"})
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     * @Groups({"blogpost"})
     */
    private $category;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

    /**
     *
     * @var type
     * @Groups({"blogpost"})
     */
    private $languageId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Section")
     * @ORM\JoinColumn(name="section_id", referencedColumnName="id")
     */
    private $section;

    /**
     *
     * @var type
     * @Groups({"blogpost"})
     */
    private $sectionId;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Alias", inversedBy="blogpost", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="alias_id", referencedColumnName="id")
     */
    private $alias;

    /**
     *
     * @var type
     * @Groups({"blogpost"})
     */
    private $aliasId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     *
     * @var type
     * @Groups({"blogpost"})
     */
    private $statusId;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->language = new ArrayCollection();
        $this->section = new ArrayCollection();
        $this->status = new ArrayCollection();
        $this->alias = new ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     * @return BlogPost
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
     * Set subtitle
     *
     * @param string $subtitle
     * @return BlogPost
     */
    public function setSubTitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subtitle;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return BlogPost
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return BlogPost
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return BlogPost
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set tag
     *
     * @param string tag
     * @return tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set category
     *
     * @param string category
     * @return BlogPost
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get section
     *
     * @return Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set section
     *
     * @param integer section
     * @return Section
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get language
     *
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param integer language
     * @return Page's Language
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get alias
     *
     * @return Alias
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set alias
     *
     * @param integer alias
     * @return Page's Alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get status
     *
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param integer status
     * @return Page's Status
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getLanguageId()
    {
        return $this->getLanguage()->getId();
    }

    public function getSectionId()
    {
        return $this->getSection()->getId();
    }

    public function getAliasId()
    {
        return $this->getAlias()->getId();
    }

    public function getStatusId()
    {
        return $this->getStatus()->getId();
    }
}
