<?php

namespace Sweepo\BettingBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Sweepo\BettingBundle\Entity\Bet;

class LoadBetData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $bet = new Bet();
        $bet->setUser($this->getReference('remy'));
        $bet->setFirstTeam($this->getReference('Paris Saint-Germain'));
        $bet->setSecondTeam($this->getReference('Bayern Munich'));
        $bet->setLeague($this->getReference('Ligue 1'));
        $bet->setBet('loltest');
        $bet->setType('test');
        $bet->setOdds(2.3);
        $bet->setStakePercent(4.5);
        $bet->setStakeEuro(4.5);
        $bet->setResult(true);
        $bet->setGainLoss(3.4);
        $bet->setProfit(2.3);
        $manager->persist($bet);

        $bet = new Bet();
        $bet->setUser($this->getReference('remy'));
        $bet->setFirstTeam($this->getReference('Leverkusen'));
        $bet->setSecondTeam($this->getReference('Dortmund'));
        $bet->setLeague($this->getReference('Ligue 1'));
        $bet->setBet('loltest');
        $bet->setType('test');
        $bet->setOdds(2.3);
        $bet->setStakePercent(4.5);
        $bet->setStakeEuro(4.5);
        $bet->setResult(true);
        $bet->setGainLoss(3.4);
        $bet->setProfit(2.3);
        $manager->persist($bet);

        $manager->flush();
    }

    public function getOrder()
    {
        return 30;
    }
}