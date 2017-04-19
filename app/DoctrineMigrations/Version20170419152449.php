<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CMS2\BaseBundle\Entity\Language;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170419152449 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    private $entityManager;

    private $languages = [
        ['language' => 'English', 'code' => 'en_GB'],
        ['language' => 'Português', 'code' => 'pt_PT']
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
        foreach($this->languages as $language) {
            $newLanguage = new Language();
            $newLanguage->setLanguage($language['language']);
            $newLanguage->setCode($language['code']);

            $this->entityManager->persist($newLanguage);
            $this->entityManager->flush($newLanguage);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        foreach($this->languages as $language)
        {
            $oldLanguage = $this->entityManager->getRepository('CMS2BaseBundle:Section')->findOneByLanguage($language['language']);

            $this->entityManager->remove($oldLanguage);
            $this->entityManager->flush($oldLanguage);
        }
    }
}
