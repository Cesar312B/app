<?php

namespace App\Repository;

use App\Entity\Materia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Materia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materia[]    findAll()
 * @method Materia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MateriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materia::class);
    }


     /* Notas admin
  */
  public function Clas(){

    
 


    $q= $this->getEntityManager()->createQueryBuilder();
  
    $q->select('c.id','c.Materia','c.Duracion','z.Nivel','v.Carrera' )
    ->from('App:materia','c')
    ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
    ->innerJoin('App:carrera','v', \Doctrine\ORM\Query\Expr\Join::WITH,'v=c.Carrera' )
 
  
    ;
     
   
    

  return $q->getQuery()->getResult();
}



  public function Clas2($id_user){

    
 


    $q= $this->getEntityManager()->createQueryBuilder();
    
    $q->select('c.id','c.Materia','c.Duracion','v.Carrera' ,'sp.Nombre','sp.Apellido')
    ->from('App:materia','c')
    ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
    ->innerJoin('App:carrera','v', \Doctrine\ORM\Query\Expr\Join::WITH,'v=c.Carrera' )
    ->innerJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=c.employed')
    ->where('sp.id=:user_id')
    ->setParameter('user_id',$id_user)
    ;
     
   
    

  return $q->getQuery()->getResult();
}






public function materia_teacher($id_user){



  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('c.id','c.Materia','c.Duracion','v.Carrera')
  ->from('App:materia','c')
  ->innerJoin('App:carrera','v', \Doctrine\ORM\Query\Expr\Join::WITH,'v=c.Carrera' )
  ->innerJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=c.employed')
  ->where('sp.id=:user_id')
  ->setParameter('user_id',$id_user)
  ;
   
return $q->getQuery()->getResult();
}














    // /**
    //  * @return Materia[] Returns an array of Materia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Materia
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
