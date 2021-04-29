<?php

namespace App\Repository;

use App\Entity\Regimes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Regimes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Regimes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Regimes[]    findAll()
 * @method Regimes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyClassRepository2 extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Regimes::class);
    }
    /**
     * Recherche les Regimes en fonction du formulaire
     * @return void
     */
    public function search($mots = null){
        $query = $this->createQueryBuilder('b');
        if($mots != null){
            $query->Where('MATCH_AGAINST(b.titre,b.description,b.imguml) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);
        }

        return $query->getQuery()->getResult();
    }
    // /**
    //  * @return Regimes[] Returns an array of Regimes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Regimes
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
