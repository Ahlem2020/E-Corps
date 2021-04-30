<?php

namespace App\Repository;

use App\Entity\CategoriePr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoriePr|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriePr|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriePr[]    findAll()
 * @method CategoriePr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriePrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriePr::class);
    }

    // /**
    //  * @return CategoriePr[] Returns an array of CategoriePr objects
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
    public function findOneBySomeField($value): ?CategoriePr
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
