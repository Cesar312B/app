<?php

namespace App\Repository;

use App\Entity\Paralelo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paralelo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paralelo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paralelo[]    findAll()
 * @method Paralelo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParaleloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paralelo::class);
    }




    
  public function m_paralelo($id_user){

  
    $q= $this->getEntityManager()->createQueryBuilder();
    
    $q->select('tp.id','tp.estado','g.Nombre AS Paralelo','c.Materia','c.id AS CD','emp.Nombre','emp.Apellido')
    ->from('App:paralelo','tp')
    ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
    ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
    ->leftJoin('App:employed','emp', \Doctrine\ORM\Query\Expr\Join::WITH,'emp=tp.employed' )
    ->where('c.id=:user_id')
    ->setParameter('user_id',$id_user)
    ;
     
   
    

  return $q->getQuery()->getResult();
}






  public function tc_paralelo($id_user){

    $q= $this->getEntityManager()->createQueryBuilder();
    
    $q->select('tp.id','g.Nombre AS Paralelo','g.id as G','v.Carrera','c.Materia','c.id AS CD','nv.Nivel')
    ->from('App:paralelo','tp')
    ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
    ->innerJoin('App:nivel','nv', \Doctrine\ORM\Query\Expr\Join::WITH,'nv=c.nivel' )
    ->innerJoin('App:employed','emp', \Doctrine\ORM\Query\Expr\Join::WITH,'emp=tp.employed' )
    ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
    ->innerJoin('App:carrera','v', \Doctrine\ORM\Query\Expr\Join::WITH,'v=c.Carrera' )
    ->where('emp.id=:user_id')
    ->andWhere($q->expr()->like('tp.estado', ':estado'))
    ->setParameter('user_id',$id_user)
    ->setParameter('estado','%Activado%');
    ;
  return $q->getQuery()->getResult();
}


    // /**
    //  * @return Paralelo[] Returns an array of Paralelo objects
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
    public function findOneBySomeField($value): ?Paralelo
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
