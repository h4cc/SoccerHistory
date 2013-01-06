<?php

namespace Sweepo\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Sweepo\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $factory = $this->container->get('security.encoder_factory');

        $user = new User();
        $user->setUsername('remy');
        $user->setPassword('pass');
        $user->encodePassword($factory);
        $user->setEmail('r.gazelot@gmail.com');
        $user->setIsActive(true);
        $user->setStock(200);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('bob');
        $user->setPassword('pass');
        $user->encodePassword($factory);
        $user->setEmail('bob@bob.com');
        $user->setStock(200);
        $user->setIsActive(true);
        $this->setReference('bob', $user);
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}