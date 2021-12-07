<?php

namespace App\Repository;

use App\Entity\AuditoriaMatricula;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AuditoriaMatricula|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuditoriaMatricula|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuditoriaMatricula[]    findAll()
 * @method AuditoriaMatricula[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuditoriaMatriculaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuditoriaMatricula::class);
    }

    public function matricula(){

    
     
         $q= $this->getEntityManager()->createQueryBuilder();
         
         $q->select('n.id','n.accion','n.fecha','sp.Nombre','sp.Apellido','g.Nombre AS Paralelo','m.Materia', 'st.Nombre AS SNombre','st.Apellido AS SApellido')
         ->from('App:auditoriamatricula','n')
         ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=n.employed')
         ->innerJoin('App:notas','x', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=x.employed')
        ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=x.student')
         ->innerJoin('App:paralelo','t', \Doctrine\ORM\Query\Expr\Join::WITH,'t=x.paralelo')
         ->innerJoin('App:materia','m', \Doctrine\ORM\Query\Expr\Join::WITH,'m=t.materia')
         ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=t.grupo')
         ;
       return $q->getQuery()->getResult();
     }

    // /**
    //  * @return AuditoriaMatricula[] Returns an array of AuditoriaMatricula objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AuditoriaMatricula
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
