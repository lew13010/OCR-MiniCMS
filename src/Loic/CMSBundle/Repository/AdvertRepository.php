<?php

namespace Loic\CMSBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByCategories($category)
    {
        $qb =  $this->createQueryBuilder('a')
            ->select('a')
            ->leftJoin('a.categories', 'c')
            ->addSelect('c');

        $qb = $qb->add('where', $qb->expr()->in('c', ':c'))
            ->setParameter('c', $category)
            ->getQuery()
            ->getResult();

        return $qb;
    }
}