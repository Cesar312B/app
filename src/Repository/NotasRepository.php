<?php

namespace App\Repository;

use App\Entity\Notas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\AST\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Notas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notas[]    findAll()
 * @method Notas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notas::class);
    }
 

 
  public function BuscarNotas($id_user){

   $conn = $this->getEntityManager()
    ->getConnection();
    $sql = "SELECT MAX(fecha) FROM periodo";
$stmt = $conn->prepare($sql);
$stmt->execute();
$at=dump($stmt->fetchAll());

    $q= $this->getEntityManager()->createQueryBuilder();
    
    $q->select('n.id','n.Estado','n.jornada','n.tipo_matricula','v.Carrera','c.Materia','c.Duracion','g.Nombre AS Paralelo','z.Nivel','v.modalidad_carrera','n.nota1','n.nota2','n.nota3', 'n.nota4' ,'n.nota5', 'n.nota6','n.nota7','n.nota8','n.nota9','n.nota10','n.nota11','n.nota12','n.nota13','n.nota14','n.nota15','n.nota_supletorio',
    '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5 AS Parcial1',
    '(n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5 AS Parcial2',
    '(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 AS Parcial3',
    '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5    AS Total',
    '((n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 ) + (n.nota_supletorio *3)/10  AS Supletorio',
    'n.Estado','p.Periodo'
    )
    ->from('App:notas','n')
    ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
    ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
    ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
    ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
    ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
    ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
    ->innerJoin('App:carrera','v', \Doctrine\ORM\Query\Expr\Join::WITH,'v=c.Carrera' )
      ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
    ->where('st.id=:user_id')
    ->andWhere('p.Fecha=:ut')
    ->setParameter('user_id',$id_user)
    ->setParameter('ut',$at)
    ;
  return $q->getQuery()->getResult();
}


public function Record($id_user){


  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('n.id','n.Estado','v.Carrera','c.Materia','g.Nombre AS Paralelo','z.Nivel','p.Periodo','n.nota1','n.nota2','n.nota3', 'n.nota4' ,'n.nota5', 'n.nota6','n.nota7','n.nota8','n.nota9','n.nota10','n.nota11','n.nota12','n.nota13','n.nota14','n.nota15','n.nota_supletorio',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5 AS Parcial1',
  '(n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5 AS Parcial2',
  '(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 AS Parcial3',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5    AS Total',
  '((n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 ) + (n.nota_supletorio *3)/10  AS Supletorio',
  'n.Estado','p.Periodo'
  )
  ->from('App:notas','n')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
  ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->innerJoin('App:carrera','v', \Doctrine\ORM\Query\Expr\Join::WITH,'v=c.Carrera' )
  ->where('st.id=:user_id')
  ->setParameter('user_id',$id_user)
  ->orderBy('n.id','DESC','p.Fecha','DESC', )
  ;
   
 
  

return $q->getQuery()->getResult();
}


public function materia_st($id_user){
  


  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('n.id','p.Periodo','st.Nombre','st.Apellido','st.id AS AL','c.Materia','c.id AS CD','g.Nombre AS Paralelo','tp.id AS TP','z.Nivel','p.Periodo','n.nota1','n.nota2','n.nota3', 'n.nota4' ,'n.nota5', 'n.nota6','n.nota7','n.nota8','n.nota9','n.nota10','n.nota11','n.nota12','n.nota13','n.nota14','n.nota15','n.nota_supletorio',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5 AS Parcial1',
  '(n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5 AS Parcial2',
  '(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 AS Parcial3',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5    AS Total',
  '((n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 ) + (n.nota_supletorio *3)/10  AS Supletorio'
  )
  ->from('App:notas','n')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
  ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
  ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->where('tp.id=:user_id')
  ->setParameter('user_id',$id_user)
  ->orderBy('n.id','DESC','p.Fecha','DESC', )

  ;



  
   
 
  

return $q->getQuery()->getResult();
}


public function materia_st2($id_user){
  $conn = $this->getEntityManager()
  ->getConnection();
  $sql = "SELECT MAX(fecha) FROM periodo";
$stmt = $conn->prepare($sql);
$stmt->execute();


$at=dump($stmt->fetchAll());



  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('n.id','p.Periodo','n.Estado','st.Nombre','st.Apellido','st.id AS AL','c.Materia','g.Nombre AS Paralelo','tp.id AS TP','c.id AS CD','z.Nivel','p.Periodo','n.nota1','n.nota2','n.nota3', 'n.nota4' ,'n.nota5', 'n.nota6','n.nota7','n.nota8','n.nota9','n.nota10','n.nota11','n.nota12','n.nota13','n.nota14','n.nota15','n.nota_supletorio',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5 AS Parcial1',
  '(n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5 AS Parcial2',
  '(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 AS Parcial3',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5    AS Total',
  '((n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 ) + (n.nota_supletorio *3)/10  AS Supletorio'
  )
  ->from('App:notas','n')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
  ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
  ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->where('tp.id=:user_id')
  ->andWhere('p.Fecha=:ut')
  ->setParameter('user_id',$id_user)
  ->setParameter('ut',$at)
  ->orderBy('n.id','DESC','p.Fecha','DESC', )

  ;
return $q->getQuery()->getResult();
}




public function materia_st3($id_user){
  $conn = $this->getEntityManager()
  ->getConnection();
  $sql = "SELECT MAX(fecha) FROM periodo";
$stmt = $conn->prepare($sql);
$stmt->execute();


$at=dump($stmt->fetchAll());



  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('n.id','p.Periodo','tp.id AS CT','st.Nombre','st.Apellido','c.Materia','g.Nombre AS Paralelo','z.Nivel','p.Periodo','n.nota1','n.nota2','n.nota3', 'n.nota4' ,'n.nota5', 'n.nota6','n.nota7','n.nota8','n.nota9','n.nota10','n.nota11','n.nota12','n.nota13','n.nota14','n.nota15','n.nota_supletorio',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5 AS Parcial1',
  '(n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5 AS Parcial2',
  '(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 AS Parcial3',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5    AS Total',
  '((n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 ) + (n.nota_supletorio *3)/10  AS Supletorio'
  )
  ->from('App:notas','n')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
  ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
  ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->where('n.id=:user_id')
  ->andWhere('p.Fecha=:st')
  ->setParameter('user_id',$id_user)
  ->setParameter('st',$at)

  ;
return $q->getQuery()->getResult();
}





  /* Notas admin
  */
  public function BuscarNotas4($id_user){


    $q= $this->getEntityManager()->createQueryBuilder();
    
    $q->select('n.id','n.Estado','z.Nivel','c.Materia','g.Nombre AS Paralelo','v.Carrera','st.Cedula','st.Nombre','st.Apellido','n.nota1','n.nota2','n.nota3', 'n.nota4' ,'n.nota5', 'n.nota6','n.nota7','n.nota8','n.nota9','n.nota10','n.nota11','n.nota12','n.nota13','n.nota14','n.nota15','n.nota_supletorio',
    '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5 AS Parcial1',
    '(n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5 AS Parcial2',
    '(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 AS Parcial3',
    '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5    AS Total',
    '((n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 ) + (n.nota_supletorio *3)/10  AS Supletorio'
    )
    ->from('App:notas','n')
    ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
    ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
    ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
    ->innerJoin('App:carrera','v', \Doctrine\ORM\Query\Expr\Join::WITH,'v=c.Carrera' )
    ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
    ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
    ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
    ->where('p.id=:user_id')
    ->setParameter('user_id',$id_user)
    ;
     
   
    

  return $q->getQuery()->getResult();
}




public function materia_st4($id_user){
  $conn = $this->getEntityManager()
  ->getConnection();
  $sql = "SELECT MAX(fecha) FROM periodo";
$stmt = $conn->prepare($sql);
$stmt->execute();


$at=dump($stmt->fetchAll());



  $q= $this->getEntityManager()->createQueryBuilder();
  
  $q->select('n.id','n.Estado','st.Cedula','st.Nombre','st.Apellido','st.id AS AL','v.Carrera','c.Materia','g.Nombre AS Paralelo','tp.id AS TP','c.id AS CD','z.Nivel','p.Periodo','n.nota1','n.nota2','n.nota3', 'n.nota4' ,'n.nota5', 'n.nota6','n.nota7','n.nota8','n.nota9','n.nota10','n.nota11','n.nota12','n.nota13','n.nota14','n.nota15','n.nota_supletorio',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5 AS Parcial1',
  '(n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5 AS Parcial2',
  '(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 AS Parcial3',
  '(n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5    AS Total',
  '((n.nota1+n.nota2+n.nota3+n.nota4+n.nota5)/5+(+n.nota6+n.nota7+n.nota8+n.nota9+n.nota10)/5+(n.nota11+n.nota12+n.nota13+n.nota14+n.nota15)/5 ) + (n.nota_supletorio *3)/10  AS Supletorio'
  )
  ->from('App:notas','n')
  ->innerJoin('App:paralelo','tp', \Doctrine\ORM\Query\Expr\Join::WITH,'tp=n.paralelo' )
  ->innerJoin('App:materia','c', \Doctrine\ORM\Query\Expr\Join::WITH,'c=tp.materia' )
  ->innerJoin('App:nivel','z', \Doctrine\ORM\Query\Expr\Join::WITH,'z=c.nivel' )
  ->innerJoin('App:student','st', \Doctrine\ORM\Query\Expr\Join::WITH,'st=n.student' )
  ->innerJoin('App:carrera','v', \Doctrine\ORM\Query\Expr\Join::WITH,'v=c.Carrera' )
  ->innerJoin('App:periodo','p', \Doctrine\ORM\Query\Expr\Join::WITH,'p=n.periodo')
  ->leftJoin('App:employed','sp', \Doctrine\ORM\Query\Expr\Join::WITH,'sp=tp.employed')
  ->innerJoin('App:grupo','g', \Doctrine\ORM\Query\Expr\Join::WITH,'g=tp.grupo')
  ->where('sp.id=:user_id')
  ->andWhere('p.Fecha=:ut')
  ->andWhere($q->expr()->like('tp.estado', ':estado'))
  ->setParameter('user_id',$id_user)
  ->setParameter('ut',$at)
  ->setParameter('estado','%Activado%')
  ->orderBy('n.id','DESC','p.Fecha','DESC')

  ;
return $q->getQuery()->getResult();
}



    // /**
    //  * @return Notas[] Returns an array of Notas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Notas
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
