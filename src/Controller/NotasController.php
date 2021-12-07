<?php

namespace App\Controller;

use App\Entity\AuditoriaMatricula;
use App\Entity\Materia;
use App\Entity\Modulos;
use App\Entity\Notas;
use App\Entity\Paralelo;
use App\Entity\Periodo;
use App\Entity\Student;
use App\Form\fullType;
use App\Form\NotasType;
use App\Form\Parcial1Type;
use App\Form\Parcial2Type;
use App\Form\Parcial3Type;
use App\Repository\NotasRepository;
use App\Repository\PeriodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/notas")
 */
class NotasController extends AbstractController
{
    /**
     * @Route("/", name="notas_index", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tene acceso a esta pagina")
     */
    public function index(NotasRepository $notasRepository,Request $request): Response
    {

        $form =$this->createFormBuilder()
        ->add('file',FileType::class,[
            'label'=> 'Archivo Exel.(xlsx)',
            'mapped' => false,

               
            'required' => false,
        ])
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
            $file= ($form['file']->getData()); // get the file from the sent request
   
            $fileFolder = __DIR__ . '/../../public/exels/';  //choose the folder in which the uploaded file will be stored
    //choose the folder in which the uploaded file will be stored
 
        $filePathName= md5(uniqid()) .'.'. $file->getClientOriginalName();
     // apply md5 function to generate an unique identifier for the file and concat it with the file extension  
           try {
               $file->move(
                $fileFolder  , $filePathName
           
           );

           } catch (FileException $e) {
               throw  new \Exception('Error al subir archivo');
             
           }
            $spreadsheet = IOFactory::load( $fileFolder. $filePathName); // Here we are able to read from the excel file 
            $r = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array
  //dd($sheetData);

 $entityManager = $this->getDoctrine()->getManager();   
  foreach ($sheetData as $Row) 
  { 
      $id = $Row['A']; 
      $jornada=$Row['B'];
      $tipo_matricula=$Row['C'];
      $notas = $entityManager->getRepository(Notas::class)->findOneBy(array('id' => $id));

      
      $notas->setJornada($jornada);
      $notas->setTipoMatricula($tipo_matricula);
      $entityManager->persist($notas);
      $entityManager->flush();
     
      

   }
   return $this->redirect($request->getUri()); 
}

        return $this->render('notas/index.html.twig', [
            'notas' => $notasRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

        
    /**
     * @Route("/paralelo_mt", name="paralelo_mp", methods={"GET","POST"})
     * @IsGranted("ROLE_PROFESOR",message="No tene acceso a esta pagina")
     */
    public function materia_stundet3(): Response
    {
        $employe= $this->getUser();
        $em= $this->getDoctrine()->getManager();
      
        $h= $em->getRepository(Paralelo::class)->tc_paralelo($employe->getId());
    
       
        return $this->render('paralelo/p_teacher.html.twig', [
          
            'paralelos'=>$h

        ]);
    }





    
    /**
     * @Route("/notas_student", name="notas_student", methods={"GET"})
     * @IsGranted("ROLE_USER",message="No tene acceso a esta pagina")
     */
    public function student(NotasRepository $notasRepository,PeriodoRepository $periodoRepository)
    {
        $student= $this->getUser();
        $em= $this->getDoctrine()->getManager();
        $notas = $em->getRepository(Notas::class)->BuscarNotas($student->getId()); 
        return $this->render('notas/student.html.twig', [
            'notas' => $notas,
            'periodos'=>$periodoRepository->periodo_academico(),
        ]);
    }

    



    /**
     * @Route("/student_record", name="student_record", methods={"GET"})
     * @IsGranted("ROLE_USER",message="No tene acceso a esta pagina")
     */
    public function studentrecord(NotasRepository $notasRepository)
    {
        $student= $this->getUser();
        $em= $this->getDoctrine()->getManager();
        $notas = $em->getRepository(Notas::class)->Record($student->getId()); 
        return $this->render('notas/student_record.html.twig', [
            'notas' => $notas
        ]);
    }




    /**
     * @Route("/notas_tc", name="notas_tc", methods={"GET"})
     * @IsGranted("ROLE_PROFESOR",message="No tene acceso a esta pagina")
     */
    public function employes(NotasRepository $notasRepository)
    {
      
        $employe= $this->getUser();
        $notas =$notasRepository->materia_st4($employe->getId());
        return $this->render('notas/emp.html.twig', [
            'notas' => $notas,
            'emp'=>$employe
        ]);
    }


    /**
     * @Route("/notas_admin/{id}", name="notas_admin", methods={"GET"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function admin(NotasRepository $notasRepository,$id)
    {
        $em= $this->getDoctrine()->getManager();
        
        $periodo= $em->getRepository(Periodo::class)->find($id);
        $notas2= $em->getRepository(Notas::class)->BuscarNotas4($periodo->getId()); 
        return $this->render('notas/admin.html.twig', [
            'notas' => $notas2,
            'periodo'=>$periodo
        ]);
    }







    /**
     * @Route("/new", name="notas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employed= $this->getUser();
        $nota = new Notas();
        $form = $this->createForm(NotasType::class, $nota);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $auditoria= new AuditoriaMatricula();
            $auditoria->setEmployed($employed);
            $auditoria->setNotas($nota);
            $auditoria->setAccion('Registro');
            $entityManager->persist($nota);
            $entityManager->persist($auditoria);
            $entityManager->flush();

            return $this->redirectToRoute('notas_admin');
        }

        return $this->render('notas/new.html.twig', [
            'nota' => $nota,
            'form' => $form->createView(),
        ]);
    }











    /**
     * @Route("/{id}", name="notas_show", methods={"GET"})
     */
    public function show(Notas $nota): Response
    {
        return $this->render('notas/show.html.twig', [
            'nota' => $nota,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="notas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Notas $nota): Response
    {
        $form = $this->createForm(NotasType::class, $nota);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('notas_index');
        }

        return $this->render('notas/edit.html.twig', [
            'nota' => $nota,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}/full", name="full", methods={"GET","POST"})
     */
    public function fullnota(Request $request, Notas $nota): Response
    {
        $form = $this->createForm(fullType::class, $nota);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('notas_index');
        }

        return $this->render('notas/fullnota.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/parcial1/paralelo/{p}/mat/{m}/al/{a}", name="parcial1", methods={"GET","POST"})
     * @IsGranted("ROLE_PROFESOR",statusCode=404,message="No tiene acceso a esta pagina")
     */
    public function parcial1(Request $request,$p,$m,$a,$id): Response
    {
     
      $em= $this->getDoctrine()->getManager();
         
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $perfil= $repository->findOneBy([
            'nombre' => 'Parcial_1',
        ]);

        $notas= new Notas();
       
        $notas = $this->getDoctrine()->getRepository(Notas::class)->find($id);
        $student= $em->getRepository(Student::class)->find($a);
        $paralelo= $em->getRepository(Paralelo::class)->find($p);
        $materia= $em->getRepository(Materia::class)->find($m);
     
        $form = $this->createForm(Parcial1Type::class, $notas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito', 'Editado con exito');
            return $this->redirect($request->getUri());
        }

        return $this->render('notas/parcial1.html.twig', [
            'nota'=>$notas,
            'student'=>$student,
            'materias'=> $materia,
            'paralelo'=>$paralelo,
            'form' => $form->createView(),
            'modulo'=>$perfil,
        ]);
    }


    /**
     * @Route("/{id}/parcial2/paralelo/{p}/mat/{m}/al/{a}",name="parcial2",methods={"GET","POST"})
     * @IsGranted("ROLE_PROFESOR",statusCode=404,message="No tiene acceso a esta pagina")
     */
    public function parcial2(Request $request,$id,$p,$m,$a): Response
    {
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $perfil= $repository->findOneBy([
            'nombre' => 'Parcial_2',
        ]);

        $notas= new Notas();
        $em= $this->getDoctrine()->getManager();
        $notas = $this->getDoctrine()->getRepository(Notas::class)->find($id);
        $student= $em->getRepository(Student::class)->find($a);
        $paralelo= $em->getRepository(Paralelo::class)->find($p);
        $materia= $em->getRepository(Materia::class)->find($m);
        $form = $this->createForm(Parcial2Type::class, $notas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito', 'Editado con exito');
            return $this->redirect($request->getUri());
        }

        return $this->render('notas/parcial2.html.twig', [
            'nota'=>$notas,
            'student'=>$student,
            'materias'=> $materia,
            'paralelo'=>$paralelo,
            'form' => $form->createView(),
            'modulo'=>$perfil,
        ]);
    }

    /**
     * @Route("/{id}/parcial3/paralelo/{p}/mat/{m}/al/{a}",name="parcial3",methods={"GET","POST"})
     * @IsGranted("ROLE_PROFESOR",statusCode=404,message="No tiene acceso a esta pagina")
     */
    public function parcial3(Request $request,$id,$p,$m,$a): Response
    {
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $perfil= $repository->findOneBy([
            'nombre' => 'Parcial_3',
        ]);

        $notas= new Notas();
        $em= $this->getDoctrine()->getManager();
        $notas = $this->getDoctrine()->getRepository(Notas::class)->find($id);
        $student= $em->getRepository(Student::class)->find($a);
        $paralelo= $em->getRepository(Paralelo::class)->find($p);
        $materia= $em->getRepository(Materia::class)->find($m);
        $form = $this->createForm(Parcial3Type::class, $notas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('exito', 'Editado con exito');
            return $this->redirect($request->getUri());
        }

        return $this->render('notas/parcial3.html.twig', [
            'nota'=>$notas,
            'student'=>$student,
            'materias'=> $materia,
            'paralelo'=>$paralelo,
            'form' => $form->createView(),
            'modulo'=>$perfil,
        ]);
    }  
    
    /**
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     * @Route("/{id}", name="delate_nota",  methods={"DELETE"})
     * 
     */
    public function delete2($id) {

        $nota= $this->getDoctrine()->getRepository(Notas::class)->find($id);
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($nota);
          $entityManager->flush();
    
          $response = new Response();
          $response->send();
        }
    
 
}




