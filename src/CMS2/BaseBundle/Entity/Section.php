<?php

namespace CMS2\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Section.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Section
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"section"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Section", type="string", unique=true, length=255)
     * @Groups({"section"})
     */
    protected $section;

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
     * Set section.
     *
     * @param string $section
     *
     * @return Name
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section.
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /*
     * This method is needed for EasyAdmin Bundle to return correctly the values
     * to the forms
     */
    public function __toString()
    {
        return $this->section;
    }
}
