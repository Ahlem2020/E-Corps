<?php

namespace App\Repository;
use App\Entity\Participante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Participante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participante[]    findAll()
 * @method Participante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participante::class);
    }

    public function findUser ($user_id): ?Participante {
        return $this
            ->createQueryBuilder('q')
            ->andWhere('q.id= :val')
            ->setParameter('val',$user_id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function FindByConcId($id)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q. = :val')
            ->setParameter('val', $id)
            ->orderBy('q.idParticipant', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findOneByConcour($concour): ?Participante
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.idParticipant = :val')
            ->setParameter('val', $concour)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findByConcour($idConcour)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.idParticipant = :val')
            ->setParameter('val', $idParticipant)
            ->orderBy('c.idParticipant', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findRanks($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT  v.video_id 
  FROM
  votes v
  WHERE v.video_id IN
     ( SELECT video_id FROM participation c WHERE c.concour_id = "'.$id.'"
  ) 
  
 GROUP by v.video_id
 ORDER by count(v.video_id) DESC
 LIMIT 3';
        $stmt = $conn->prepare($sql);

        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();


    }
    /**
     * Returns number of "participations" per day
     * @return void
     */
    public function countByDate(){

        $query = $this->getEntityManager()->createQuery("
                SELECT SUBSTRING(a.dateParticipation, 1, 10) as dateParticipation, COUNT(a) as count FROM App\Entity\Participation 
                a GROUP BY dateParticipation
        ");
        return $query->getResult();
    }


//    public function findParticipantByAge($age){
//        return $this->createQueryBuilder('c')
//            ->where('c.age LIKE :age')
//            ->setParameter('age', '%'.$age.'%')
//            ->getQuery()
//            ->getResult();
//    }





}

