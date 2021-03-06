<?php

namespace CMS2\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Language.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Language
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"language"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", unique=true, length=255)
     * @Groups({"language"})
     */
    protected $language;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", unique=true, length=5)
     * @Groups({"language"})
     */
    private $code;

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
     * Set language.
     *
     * @param string $language
     *
     * @return Language
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Language
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /*
     * This method is needed for EasyAdmin Bundle to return correctly the values
     * to the forms
     */
    public function __toString()
    {
        return $this->language;
    }
}
