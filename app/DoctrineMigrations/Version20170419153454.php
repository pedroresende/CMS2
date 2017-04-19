<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CMS2\BaseBundle\Entity\Setting;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170419153454 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;
    private $entityManager;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container     = $container;
        $this->entityManager = $this->container->get('doctrine')->getManager();
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $setting = new Setting();

        $setting->setAuthor('Pedro Resende');
        $setting->setBlog(true);
        $setting->setDescription('Some Description');
        $setting->setKeywords('keywords');
        $setting->setSitename('Development');

        $this->entityManager->persist($setting);
        $this->entityManager->flush($setting);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $oldSetting = $this->entityManager->getRepository('CMS2BaseBundle:Setting')->find(1);

        $this->entityManager->remove($oldSetting);
        $this->entityManager->flush($oldSetting);
    }
}