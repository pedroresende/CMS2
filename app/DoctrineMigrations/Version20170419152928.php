<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CMS2\BaseBundle\Entity\Status;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170419152928 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    private $entityManager;

    private $status = [
        ['status' => 'Draft'],
        ['status' => 'Published'],
        ['status' => 'Arquived']
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
        foreach($this->status as $status) {
            $newStatus = new Status();
            $newStatus->setStatus($status['status']);

            $this->entityManager->persist($newStatus);
            $this->entityManager->flush($newStatus);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        foreach($this->status as $status)
        {
            $oldStatus = $this->entityManager->getRepository('CMS2BaseBundle:Status')->findOneByStatus($status['status']);

            $this->entityManager->remove($oldStatus);
            $this->entityManager->flush($oldStatus);
        }
    }
}
