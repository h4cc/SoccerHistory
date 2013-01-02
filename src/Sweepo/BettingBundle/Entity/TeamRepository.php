<?php

namespace Sweepo\BettingBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TeamRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TeamRepository extends EntityRepository
{
    public function findByLike($name)
    {
        $qb = $this->createQueryBuilder('t');

        return $qb->where($qb->expr()->like('t.name', "'%{$name}%'"))
            ->orderBy('t.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
