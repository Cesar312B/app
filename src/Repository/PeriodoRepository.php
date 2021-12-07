<?php

namespace App\Repository;

use App\Entity\Periodo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Periodo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Periodo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Periodo[]    findAll()
 * @method Periodo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Periodo::class);
    }

    public function periodo_academico(){

        $conn = $this->getEntityManager()
         ->getConnection();
         $sql = "SELECT MAX(fecha) FROM periodo";
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $at=dump($stmt->fetchAll());
     
         $q= $this->getEntityManager()->createQueryBuilder();
         
         $q->select('n.Periodo')
         ->from('App:periodo','n')

         ->andWhere('n.Fecha=:ut')
         ->setParameter('ut',$at)
         ;
       return $q->getQuery()->getResult();
     }

    // /**
    //  * @return Periodo[] Returns an array of Periodo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Periodo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
