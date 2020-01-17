<?php

namespace App\Repository;

use App\Entity\TrekkingRoutes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TrekkingRoutes|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrekkingRoutes|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrekkingRoutes[]    findAll()
 * @method TrekkingRoutes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrekkingRoutesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrekkingRoutes::class);
    }

    // /**
    //  * @return TrekkingRoutes[] Returns an array of TrekkingRoutes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TrekkingRoutes
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
