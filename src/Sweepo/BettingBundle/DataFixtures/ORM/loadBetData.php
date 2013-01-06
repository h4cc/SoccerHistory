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
        $operations = $this->container->get('sweepo_betting.operations');

        $bet = new Bet();
        $bet->setUser($this->getReference('bob'));
        $bet->setFirstTeam($this->getReference('Paris Saint-Germain'));
        $bet->setSecondTeam($this->getReference('Bayern Munich'));
        $bet->setLeague($this->getReference('Ligue 1'));
        $bet->setBet('loltest');
        $bet->setType('test');
        $bet->setOdds(1.78);
        $bet->setStake(2);
        $bet->setStakeType(Bet::PERCENT);
        $bet->setResult(true);
        $bet->setGainLoss($operations->gainLoss($bet, $this->getReference('bob')->getStock()));
        $bet->setProfit($operations->profit($bet, $this->getReference('bob')->getStock()));
        $bet->setDate(new \Datetime());
        $manager->persist($bet);

        $bet = new Bet();
        $bet->setUser($this->getReference('bob'));
        $bet->setFirstTeam($this->getReference('Leverkusen'));
        $bet->setSecondTeam($this->getReference('Dortmund'));
        $bet->setLeague($this->getReference('Ligue 1'));
        $bet->setBet('loltest');
        $bet->setType('test');
        $bet->setOdds(2.3);
        $bet->setStake(5);
        $bet->setStakeType(Bet::EURO);
        $bet->setResult(true);
        $bet->setGainLoss($operations->gainLoss($bet, $this->getReference('bob')->getStock()));
        $bet->setProfit($operations->profit($bet, $this->getReference('bob')->getStock()));
        $bet->setDate(new \Datetime());
        $manager->persist($bet);

        $manager->flush();
    }

    public function getOrder()
    {
        return 30;
    }
}