<?php

namespace App\Repository;

use App\Entity\Horario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Horario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Horario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Horario[]    findAll()
 * @method Horario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Horario::class);
    }

    public function h_paralelo ($id_user){

        $q= $this->getEntityManager()->createQueryBuilder();
        $q->select('h.id','tp.id AS TP', 'c.Materia','c.id AS CD','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel' )
        ->from('App:horario','h')
        ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
        ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
        ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
        ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
        ->where('tp.id=:user_id')
        ->setParameter('user_id',$id_user);
      return $q->getQuery()->getResult();
    }


    public function h_teacher ($id_user){

      $q= $this->getEntityManager()->createQueryBuilder();
      $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel' )
      ->from('App:horario','h')
      ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
      ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
      ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
      ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
      ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
      ->where('sp.id=:user_id')
      ->andWhere($q->expr()->like('h.Dia', ':dia'))
      ->setParameter('user_id',$id_user)
      ->setParameter('dia','%Lunes%');
    return $q->getQuery()->getResult();
  }


  
  public function h_teacher2 ($id_user){

    $q= $this->getEntityManager()->createQueryBuilder();
    $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel' )
    ->from('App:horario','h')
    ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
    ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
    ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
    ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
    ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
    ->where('sp.id=:user_id')
    ->andWhere($q->expr()->like('h.Dia', ':dia'))
    ->setParameter('user_id',$id_user)
    ->setParameter('dia','%Martes%');
  return $q->getQuery()->getResult();
}



public function h_teacher3 ($id_user){

  $q= $this->getEntityManager()->createQueryBuilder();
  $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel' )
  ->from('App:horario','h')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
  ->where('sp.id=:user_id')
  ->andWhere($q->expr()->like('h.Dia', ':dia'))
  ->setParameter('user_id',$id_user)
  ->setParameter('dia','%Miercoles%');
return $q->getQuery()->getResult();
}



public function h_teacher4 ($id_user){

  $q= $this->getEntityManager()->createQueryBuilder();
  $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel' )
  ->from('App:horario','h')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
  ->where('sp.id=:user_id')
  ->andWhere($q->expr()->like('h.Dia', ':dia'))
  ->setParameter('user_id',$id_user)
  ->setParameter('dia','%Jueves%');
return $q->getQuery()->getResult();
}




public function h_teacher5 ($id_user){

  $q= $this->getEntityManager()->createQueryBuilder();
  $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel' )
  ->from('App:horario','h')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
  ->where('sp.id=:user_id')
  ->andWhere($q->expr()->like('h.Dia', ':dia'))
  ->setParameter('user_id',$id_user)
  ->setParameter('dia','%Viernes%');
return $q->getQuery()->getResult();
}




public function h_teacher6 ($id_user){

  $q= $this->getEntityManager()->createQueryBuilder();
  $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel' )
  ->from('App:horario','h')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
  ->where('sp.id=:user_id')
  ->andWhere($q->expr()->like('h.Dia', ':dia'))
  ->setParameter('user_id',$id_user)
  ->setParameter('dia','%Sabado%');
return $q->getQuery()->getResult();
}
  
    

    public function h_student ($id_user){
      $conn = $this->getEntityManager()
      ->getConnection();
      $sql = "SELECT MAX(fecha) FROM periodo";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $at=dump($stmt->fetchAll());
        $q= $this->getEntityManager()->createQueryBuilder();
        $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel', 'sp.Nombre','sp.Apellido' )
        ->from('App:horario','h')
        ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
        ->innerJoin('App:notas','n', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
        ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
        ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
        ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
        ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
        ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
         ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
        ->where('st.id=:user_id')
        ->andWhere($q->expr()->like('h.Dia', ':dia'))
        ->andWhere('p.Fecha=:ut')
        ->setParameter('user_id',$id_user)
        ->setParameter('dia','%Lunes%')
        ->setParameter('ut',$at)
        ;  
      return $q->getQuery()->getResult();
    }


    
    public function h_student2 ($id_user){
         
      $conn = $this->getEntityManager()
      ->getConnection();
      $sql = "SELECT MAX(fecha) FROM periodo";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  
  
  $at=dump($stmt->fetchAll());
        $q= $this->getEntityManager()->createQueryBuilder();
        $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel','sp.Nombre','sp.Apellido' )
        ->from('App:horario','h')
        ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
        ->innerJoin('App:notas','n', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
        ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
        ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
        ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
        ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
        ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
         ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
        ->where('st.id=:user_id')
        ->andWhere($q->expr()->like('h.Dia', ':dia'))
        ->andWhere('p.Fecha=:ut')
        ->setParameter('user_id',$id_user)
        ->setParameter('dia','%Martes%')
        ->setParameter('ut',$at)
        ;

      return $q->getQuery()->getResult();
    }


        
    public function h_student3 ($id_user){
      $conn = $this->getEntityManager()
      ->getConnection();
      $sql = "SELECT MAX(fecha) FROM periodo";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  
  
  $at=dump($stmt->fetchAll());

        $q= $this->getEntityManager()->createQueryBuilder();
        $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel', 'sp.Nombre','sp.Apellido' )
        ->from('App:horario','h')
        ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
        ->innerJoin('App:notas','n', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
        ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
        ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
        ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
        ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
        ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
         ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
        ->where('st.id=:user_id')
        ->andWhere($q->expr()->like('h.Dia', ':dia'))
        ->andWhere('p.Fecha=:ut')
        ->setParameter('user_id',$id_user)
        ->setParameter('dia','%Miercoles%')
        ->setParameter('ut',$at)
        ;

        
      return $q->getQuery()->getResult();
    }


        
    public function h_student4 ($id_user){
      $conn = $this->getEntityManager()
      ->getConnection();
      $sql = "SELECT MAX(fecha) FROM periodo";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  
  
  $at=dump($stmt->fetchAll());

        $q= $this->getEntityManager()->createQueryBuilder();
        $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel','sp.Nombre','sp.Apellido' )
        ->from('App:horario','h')
        ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
        ->innerJoin('App:notas','n', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
        ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
        ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
        ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
        ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
        ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
         ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
        ->where('st.id=:user_id')
        ->andWhere($q->expr()->like('h.Dia', ':dia'))
        ->andWhere('p.Fecha=:ut')
        ->setParameter('user_id',$id_user)
        ->setParameter('dia','%Jueves%')
        ->setParameter('ut',$at)
        ;

        
      return $q->getQuery()->getResult();
    }


         
    public function h_student5 ($id_user){
      $conn = $this->getEntityManager()
      ->getConnection();
      $sql = "SELECT MAX(fecha) FROM periodo";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  
  
  $at=dump($stmt->fetchAll());

        $q= $this->getEntityManager()->createQueryBuilder();
        $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel','sp.Nombre','sp.Apellido' )
        ->from('App:horario','h')
        ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
        ->innerJoin('App:notas','n', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
        ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
        ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
        ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
        ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
        ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
         ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
        ->where('st.id=:user_id')
        ->andWhere($q->expr()->like('h.Dia', ':dia'))
        ->andWhere('p.Fecha=:ut')
        ->setParameter('user_id',$id_user)
        ->setParameter('dia','%Viernes%')
        ->setParameter('ut',$at)
        ;

        
      return $q->getQuery()->getResult();
    }


         
    public function h_student6 ($id_user){
      $conn = $this->getEntityManager()
      ->getConnection();
      $sql = "SELECT MAX(fecha) FROM periodo";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  
  
  $at=dump($stmt->fetchAll());

        $q= $this->getEntityManager()->createQueryBuilder();
        $q->select('h.id', 'c.Materia','g.Nombre AS Paralelo','h.Dia','h.Hora_inicio','h.Hora_salida','z.Nivel','sp.Nombre','sp.Apellido')
        ->from('App:horario','h')
        ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=h.paralelo' )
        ->innerJoin('App:notas','n', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
        ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
        ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
        ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
        ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
        ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
         ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
        ->where('st.id=:user_id')
        ->andWhere($q->expr()->like('h.Dia', ':dia'))
        ->andWhere('p.Fecha=:ut')
        ->setParameter('user_id',$id_user)
        ->setParameter('dia','%Sabado%')
        ->setParameter('ut',$at)
        ;

        
      return $q->getQuery()->getResult();
    }
    
    
    




    // /**
    //  * @return Horario[] Returns an array of Horario objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Horario
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
