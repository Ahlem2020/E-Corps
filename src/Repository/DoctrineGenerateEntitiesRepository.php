<?php

namespace App\Repository;

use App\Entity\DoctrineGenerateEntities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DoctrineGenerateEntities|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoctrineGenerateEntities|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoctrineGenerateEntities[]    findAll()
 * @method DoctrineGenerateEntities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineGenerateEntitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrineGenerateEntities::class);
    }

    // /**
    //  * @return DoctrineGenerateEntities[] Returns an array of DoctrineGenerateEntities objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DoctrineGenerateEntities
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
