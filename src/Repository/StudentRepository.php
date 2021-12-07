<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }


    
/* Notas para el ptofesor segun quienes cojen su materia 
  */
  public function BuscarEst(){
  
     
    $conn = $this->getEntityManager()
    ->getConnection();
    $sql = "SELECT fecha
    FROM periodo 
    WHERE fecha = (
        SELECT MAX(fecha)
        FROM periodo)";
$stmt = $conn->prepare($sql);
$stmt->execute();


$at=dump($stmt->fetchAll());
 
 
     $q= $this->getEntityManager()->createQueryBuilder();
     
     $q->select('st.Nombre'
   
     )
     ->from('App:notas','n')
     ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=n.materia' )
     ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
     ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
     ->andWhere('p.Fecha=:st')
     ->setParameter('st',$at)
     ->orderBy('st.Nombre','ASC')
     ;

 }
 

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
