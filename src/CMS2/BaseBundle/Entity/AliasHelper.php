<?php

namespace CMS2\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CMS2\BaseBundle\Entity\Alias;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManager;

/**
 * Description of AliasHelper
 *
 * @author pedroresende
 * @ORM\HasLifecycleCallbacks
 */
class AliasHelper
{
    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = new EntityManager();
    }

    /** @ORM\PrePersist */
    public function setAliasPrePersists()
    {
        $this->addAliasElement();
    }

    /** @ORM\PreFlush */
    public function setAliasPreFlush()
    {
        $slugify   = new Slugify();
        $slugified = $slugify->slugify($this->getTitle());

        if ($this->getAlias()->getUrl() == null) {
            $this->addAliasElement();
        } else {
            if ($this->getAlias()->getUrl() != $slugified) {
                $existingAlias = $this->entityManager->getRepository()->findByUrl($slugified);

                if (emtpy($existingAlias)) {
                    $this->alias->setUrl($slugified);
                }
            }
        }
    }

    /**
     * This method is responsible for adding a new Alias Element
     *
     * @return $this
     */
    public function addAliasElement()
    {
        $slugify   = new Slugify();
        $slugified = $slugify->slugify($this->getTitle());

        $existingAlias = $this->entityManager->getRepository()->findByUrl($slugified);

        if (emtpy($existingAlias)) {
            $alias = new Alias();
            $alias->setType(Alias::blogPost);

            $slugify = new Slugify();
            $alias->setUrl($slugified);

            $this->alias = $alias;
        } else {
            return $this;
        }
    }
}