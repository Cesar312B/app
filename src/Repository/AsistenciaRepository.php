<?php

namespace App\Repository;

use App\Entity\Asistencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asistencia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asistencia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asistencia[]    findAll()
 * @method Asistencia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AsistenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asistencia::class);
    }



  /* Record de Asistencia del estudiante
  */
  public function Asistencia1($id_user){
    $conn = $this->getEntityManager()
    ->getConnection();
    $sql = "SELECT MAX(fecha) FROM periodo";
$stmt = $conn->prepare($sql);
$stmt->execute();

$at=dump($stmt->fetchAll());
    $q= $this->getEntityManager()->createQueryBuilder();
    $q->select('n.id','c.Materia','g.Nombre AS Paralelo','n.Asistencia','n.Fecha', 'z.Nivel', 'p.Periodo')
    ->from('App:asistencia','n')
    ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
    ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia')
    ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
    ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
    ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
    ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
    ->where('st.id=:user_id')
    ->andWhere('p.Fecha=:st')
    ->setParameter('user_id',$id_user)
    ->setParameter('st',$at)
    ;
  return $q->getQuery()->getResult();
}


  /* Record de Asistencia del estudiante
  */
  public function Asistencia2($id_user){

    
    $conn = $this->getEntityManager()
    ->getConnection();
    $sql = "SELECT MAX(fecha)  FROM periodo";
$stmt = $conn->prepare($sql);
$stmt->execute();


$at=dump($stmt->fetchAll());


    $q= $this->getEntityManager()->createQueryBuilder();
    
    $q->select('n.id','c.Materia','g.Nombre AS Paralelo','(SUM(n.Asistencia)*100)/c.Duracion as Faltas','z.Nivel' )
    ->from('App:asistencia','n')
    ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
    ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
    ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
    ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
    ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
    ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
    ->where('st.id=:user_id')
    ->andWhere('p.Fecha=:st')
    ->setParameter('user_id',$id_user)
    ->setParameter('st',$at)
    ->groupBy('c.Duracion','c.Materia','g.Nombre')
    ;
     
   
    

  return $q->getQuery()->getResult();
}



  /* Record de Asistencia del estudiante
  */
  public function Asistencia3($id_user,$mat_id){

    
    $conn = $this->getEntityManager()
    ->getConnection();
    $sql = "SELECT MAX(fecha)
    FROM periodo";
$stmt = $conn->prepare($sql);
$stmt->execute();


$at=dump($stmt->fetchAll());


    $q= $this->getEntityManager()->createQueryBuilder();
    
    $q->select('st.Nombre','st.Apellido','c.Materia','g.Nombre AS Paralelo','(SUM(n.Asistencia)*100)/c.Duracion as Faltas'
    
    )
    ->from('App:asistencia','n')
    ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
    ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
    ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
    ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
    ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
    ->where('st.id=:user_id')
    ->andWhere('p.Fecha=:st')
    ->andWhere('tp.id=:mat_id')
    ->setParameter('user_id',$id_user)
    ->setParameter('st',$at)
    ->setParameter('mat_id',$mat_id)
    ->groupBy('c.Duracion','c.Materia','g.Nombre','st.Nombre','st.Apellido')
    ;
     
   
    

  return $q->getQuery()->getResult();
}

    // /**
    //  * @return Asistencia[] Returns an array of Asistencia objects
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
    public function findOneBySomeField($value): ?Asistencia
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
