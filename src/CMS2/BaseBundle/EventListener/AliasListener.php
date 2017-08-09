<?php

namespace CMS2\BaseBundle\EventListener;

use CMS2\BaseBundle\Entity\Alias;
use CMS2\BaseBundle\Entity\BlogPost;
use CMS2\BaseBundle\Entity\Page;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;

/**
 * Description of AliasHelper.
 *
 * @author pedroresende
 */
class AliasListener
{
    private $entity;
    private $entityManager;

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->entity = $args->getEntity();

        if (!$this->entity instanceof Page && !$this->entity instanceof BlogPost) {
            return;
        }

        $this->entityManager = $args->getEntityManager();
        $this->addAliasElement();
    }

    /**
     * @TODO think about the preFlush
     *
     * @param PreFlushEventArgs $args
     */
    public function preFlush(PreFlushEventArgs $args)
    {
        /*$this->entity = $args->getEntity();

        if (!$this->entity instanceof Page && !$this->entity instanceof BlogPost) {
            return;
        }

        $this->entityManager = $args->getEntityManager();

        $slugify = new Slugify();
        $slugified = $slugify->slugify($this->entity->getTitle());

        if ($this->entity->getAlias()->getUrl() == null) {
            $this->addAliasElement();
        } else {
            if ($this->entity->getAlias()->getUrl() != $slugified) {
                $existingAlias = $this->entityManager->getRepository('CMS2BaseBundle:Alias')->findByUrl($slugified);

                if (emtpy($existingAlias)) {
                    $this->entity->alias->setUrl($slugified);
                }
            }
        }*/
    }

    /**
     * This method is responsible for adding a new Alias Element.
     *
     * @return $this
     */
    public function addAliasElement()
    {
        $slugify = new Slugify();
        $slugified = $slugify->slugify($this->entity->getTitle());

        $existingAlias = $this->entityManager->getRepository('CMS2BaseBundle:Alias')->findByUrl($slugified);

        if (empty($existingAlias)) {
            $alias = new Alias();

            if ($this->entity instanceof Page) {
                $alias->setType(Alias::Page);
            } else {
                $alias->setType(Alias::BlogPost);
            }

            $slugify = new Slugify();
            $alias->setUrl($slugified);

            $this->entity->setAlias($alias);
        } else {
            return;
        }
    }
}
