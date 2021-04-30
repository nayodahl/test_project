<?php

namespace App\Repository;

use App\Entity\CollectionWeek;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionWeek|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionWeek|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionWeek[]    findAll()
 * @method CollectionWeek[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionWeekRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionWeek::class);
    }

    // /**
    //  * @return CollectionWeek[] Returns an array of CollectionWeek objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CollectionWeek
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
