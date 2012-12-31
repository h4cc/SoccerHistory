<?php

namespace Sweepo\BettingBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Sweepo\BettingBundle\Entity\Team;

class LoadTeamData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $team = new Team();
        $team->setName('Paris Saint-Germain');
        $team->setLeague('Ligue 1');
        $team->setCountry('France');
        $this->setReference('paris', $team);
        $manager->persist($team);

        $team = new Team();
        $team->setName('Olympique Lyonnais');
        $team->setLeague('Ligue 1');
        $team->setCountry('France');
        $this->setReference('lyon', $team);
        $manager->persist($team);

        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}