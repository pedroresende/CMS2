<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CMS2\BaseBundle\Entity\Section;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170419151826 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    private $entityManager;

    private $sections = [
        ['name' => 'Private'],
        ['name' => 'Public']
    ];

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->entityManager = $this->container->get('doctrine')->getManager();
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        foreach($this->sections as $section) {
            $newSection = new Section();
            $newSection->setSection($section['name']);

            $this->entityManager->persist($newSection);
            $this->entityManager->flush($newSection);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        foreach($this->sections as $section)
        {
            $oldSection = $this->entityManager->getRepository('CMS2BaseBundle:Section')->findOneByName($section['name']);

            $this->entityManager->remove($oldSection);
            $this->entityManager->flush($oldSection);
        }
    }
}
