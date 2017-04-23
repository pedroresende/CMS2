<?php

namespace CMS2\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Page
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Page {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"page"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Groups({"page"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     * @Groups({"page"})
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Groups({"page"})
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Section", fetch="EAGER")
     */
    private $section;

    /**
     *
     * @Groups({"page"})
     */
    private $sectionId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Language", fetch="EAGER")
     */
    private $language;

    /**
     * @var type 
     * @Groups({"page"})
     */
    private $languageId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Status", fetch="EAGER")

     */
    private $status;

    /**
     * @var type 
     * @Groups({"page"})
     */
    private $statusId;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Alias", inversedBy="page", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="alias_id", referencedColumnName="id")
     */
    private $alias;

    /**
     * @var type 
     * @Groups({"page"})
     */
    private $aliasId;

    public function __construct() {
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
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Page
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Page
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Get section
     *
     * @return Section
     */
    public function getSection() {
        return $this->section;
    }

    /**
     * Set section
     *
     * @param integer section
     * @return Section
     */
    public function setSection($section) {
        $this->section = $section;

        return $this;
    }

    /**
     * Get sectionName
     *
     * @return SectionName
     */
    public function getSectionId() {
        return $this->getSection()->getId();
    }

    /**
     * Get language
     *
     * @return Language
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param integer language
     * @return Page's Language
     */
    public function setLanguage($language) {
        $this->language = $language;

        return $this;
    }

    /**
     * Get languageName
     *
     * @return LanguageName
     */
    public function getLanguageId() {
        return $this->getLanguage()->getId();
    }

    /**
     * Get alias
     *
     * @return Alias
     */
    public function getAlias() {
        return $this->alias;
    }

    /**
     * Set alias
     *
     * @param integer alias
     * @return Page's Alias
     */
    public function setAlias($alias) {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get aliasUrl
     *
     * @return AliasUrl
     */
    public function getAliasId() {
        return $this->getAlias()->getId();
    }

    /**
     * Get status
     *
     * @return Status
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param integer status
     * @return Page's Status
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get statusName
     *
     * @return StatusName
     */
    public function getStatusId() {
        return $this->getStatus()->getId();
    }
}
