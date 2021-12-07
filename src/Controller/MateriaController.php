<?php

namespace App\Controller;

use App\Entity\Grupo;
use App\Entity\Horario;
use App\Entity\Materia;
use App\Entity\Modulos;
use App\Entity\Notas;

use App\Form\HorarioType;

use App\Form\MateriaType;

use App\Repository\MateriaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Paralelo;
use App\Repository\NotasRepository;
use App\Repository\ParaleloRepository;
use App\Repository\PeriodoRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/materia")
 */
class MateriaController extends AbstractController
{
    /**
     * @Route("/", name="materia_index", methods={"GET"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function index(MateriaRepository $materiaRepository): Response
    {

        $em= $this->getDoctrine()->getManager();
    
     

        $materias = $em->getRepository(Materia::class)->Clas(); 
      

        return $this->render('materia/index.html.twig', [
            'materias' => $materias,
        
        ]);
    }



    
    /**
     * @Route("/new", name="materia_new", methods={"GET","POST"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function new(Request $request): Response
    {
        $materium = new Materia();
        $form = $this->createForm(MateriaType::class, $materium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materium);
            $entityManager->flush();

            return $this->redirectToRoute('materia_index');
        }

        return $this->render('materia/new.html.twig', [
            'materium' => $materium,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/materia_emp", name="materia_emp", methods={"GET","POST"})
     
     */

     /*
    public function newm(Request $request): Response
    {
        $form =$this->createFormBuilder()
        ->add('Materia')
        ->add('Hora')
        ->add('Duracion')
        ->add('Profesor',EntityType::class,[
            'class'=> Employed::class,
            'choice_label' => function (Employed $employed) {
                return $employed->getNombre() . ' ' . $employed->getApellido();
            },
              
          
        ])
        ->add('Horario',EntityType::class,[
            'class'=>Horario::class,
            'choice_label'=>'Dia'
        ])
        ->add('Unidad_Organizacional')
        ->add('Carrera',EntityType::class,[
            'class'=>Carrera::class,
            'choice_label'=>'Carrera'
        ])
        ->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
             $data= $form->getData();
             $materia= new Materia();
             $materia->setMateria($data['Materia']);
             $materia->setHora($data['Hora']);
             $materia->setDuracion($data['Duracion']);
             $materia->setEmployed($data['Profesor']);
             $materia->setHorario($data['Horario']);
            $semestre= new Semestre();
            $semestre->setUnidadOrganizacional($data['Unidad_Organizacional']);
            $semestre->setCarrera($data['Carrera']);
            $semestre->setMateria($materia);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materia);
            $entityManager->persist($semestre);
            $entityManager->flush();

            return $this->redirectToRoute('materia_index');
        }

        return $this->render('materia/materia_emp.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    */



    /**
     * @Route("/{id}", name="materia_show", methods={"GET"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function show(Materia $materium): Response
    {
        return $this->render('materia/show.html.twig', [
            'materium' => $materium,
        ]);
    }



     /**
     * @Route("/paralelo/{id}/mat/{t}", name="paralelo_horario", methods={"GET","POST"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function p_horario(Request $request,$id,$t): Response
    {
      
        $em= $this->getDoctrine()->getManager();
        $horario= new Horario();
        $paralelo= $em->getRepository(Paralelo::class)->find($id);
        $materia= $em->getRepository(Materia::class)->find($t);
        $h= $em->getRepository(Horario::class)->h_paralelo($paralelo->getId());

        $form = $this->createForm(HorarioType::class,$horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $horario->setParalelo($paralelo);
          $em->persist($horario);
          $em->flush();
          return $this->redirect($request->getUri());

        }

        return $this->render('materia/paralelo_horario.html.twig', [
              
            'form' => $form->createView(),
            'paralelo'=> $paralelo,
            'materia'=>$materia,
            'horarios'=>$h

        ]);
    }


        
     /**
     * @Route("/{id}/materia_paralelo", name="paralelos", methods={"GET","POST"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function materia_p($id, ParaleloRepository $paraleloRepository): Response
    {
      
        $em= $this->getDoctrine()->getManager();
        $materia= $em->getRepository(Materia::class)->find($id);
        $paralelo= $paraleloRepository->m_paralelo($materia->getId());
     
       
        return $this->render('materia/materia_paralelo.html.twig', [
            'materias'=> $materia,
            'paralelos'=>$paralelo,
    
            
           


        ]);
    }


    
    
     /**
     * @Route("/pa/{id}/student/{m}", name="studintes_paralelo", methods={"GET","POST"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_PROFESOR') or is_granted('ROLE_SECRETARIA')")
     */
    public function st_paralelo($id,$m,Request $request,ValidatorInterface $validator,PeriodoRepository $periodoRepository , NotasRepository $notasRepository): Response
    {
      
        $em= $this->getDoctrine()->getManager();
         
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $parcial1= $repository->findOneBy([
            'nombre' => 'Parcial_1',
        ]);

        
        $parcial2= $repository->findOneBy([
            'nombre' => 'Parcial_2',
        ]);

        
        $parcial3 = $repository->findOneBy([
            'nombre' => 'Parcial_3',
        ]);
        $paralelo= $em->getRepository(Paralelo::class)->find($id);
        $materia= $em->getRepository(Materia::class)->find($m);
        $h= $em->getRepository(Notas::class)-> materia_st($paralelo->getId());
        $g= $em->getRepository(Notas::class)-> materia_st2($paralelo->getId());
        $form =$this->createFormBuilder()
        ->add('file',FileType::class,[
            'label'=> 'Archivo Exel Parcial 1.(xlsx)',
            'mapped' => false,
            'required' => true,
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
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null,true,true,true); // here, the read data is turned into an array
//dd($sheetData);
$entityManager = $this->getDoctrine()->getManager(); 
 
  foreach ($sheetData as $Row) 
  { 
      $id = $Row['A']; 
      $nota1 = $Row['C']; 
      $descripcion1 = $Row['D']; 
      $nota2 = $Row['E']; 
      $descripcion2 = $Row['F']; 
      $nota3 = $Row['G']; 
      $descripcion3 = $Row['H']; 
      $nota4 = $Row['I']; 
      $descripcion4 = $Row['J']; 
      $nota5 = $Row['K']; 
      $descripcion5 = $Row['L']; 
      $t= $notasRepository->findOneBy(['id'=> $id]);
       $t->setNota1($nota1);
       $t->setNota1Descripcion($descripcion1);
       $t->setNota2($nota2);
       $t->setNota2Descripcion($descripcion2);
       $t->setNota3($nota3);
       $t->setNota3Descripcion($descripcion3);
       $t->setNota4($nota4);
       $t->setNota4Descripcion($descripcion4);
       $t->setNota5($nota5);
       $t->setNota5Descripcion($descripcion5);
       $entityManager->persist($t);
       $entityManager->flush();
   }
   return $this->redirect($request->getUri()); 
}


$form1 =$this->createFormBuilder()
        ->add('file1',FileType::class,[
            'label'=> 'Archivo Exel Parcial 2.(xlsx)',
            'mapped' => false,
            'required' => true,
        ])
        ->getForm();
        $form1->handleRequest($request);
        if ($form1->isSubmitted() && $form1->isValid()) {
          
            $file1= ($form1['file1']->getData()); // get the file from the sent request
   
            $fileFolder = __DIR__ . '/../../public/exels/';  //choose the folder in which the uploaded file will be stored
    //choose the folder in which the uploaded file will be stored
 
        $filePathName= md5(uniqid()) .'.'. $file1->getClientOriginalName();
     // apply md5 function to generate an unique identifier for the file and concat it with the file extension  
           try {
               $file1->move(
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
      $id_1 = $Row['A']; 
      $nota6 = $Row['C']; 
      $descripcion6 = $Row['D']; 
      $nota7 = $Row['E']; 
      $descripcion7 = $Row['F'];
      $nota8 = $Row['G'];
      $descripcion8 = $Row['H']; 
      $nota9 = $Row['I']; 
      $descripcion9 = $Row['J']; 
      $nota10 = $Row['K']; 
      $descripcion10 = $Row['L'];

      $notas_1 = $entityManager->getRepository(Notas::class)->findOneBy(array('id' => $id_1));
      $notas_1->setNota6($nota6);
      $notas_1->setNota6Descripcion($descripcion6);
      $notas_1->setNota7($nota7);
      $notas_1->setNota7Descripcion($descripcion7);
      $notas_1->setNota8($nota8);
      $notas_1->setNota8Descripcion($descripcion8);
      $notas_1->setNota9($nota9);
      $notas_1->setNota9Descripcion($descripcion9);
      $notas_1->setNota10($nota10);
      $notas_1->setNota10Descripcion($descripcion10);
      $entityManager->persist($notas_1);
      $entityManager->flush();
   }
   return $this->redirect($request->getUri()); 
}


$form2 =$this->createFormBuilder()
        ->add('file2',FileType::class,[
            'label'=> 'Archivo Exel Parcial 3.(xlsx)',
            'mapped' => false,
            'required' => true,
        ])
        ->getForm();
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {
          
            $file2= ($form2['file2']->getData()); // get the file from the sent request
   
            $fileFolder = __DIR__ . '/../../public/exels/';  //choose the folder in which the uploaded file will be stored
    //choose the folder in which the uploaded file will be stored
 
        $filePathName= md5(uniqid()) .'.'. $file2->getClientOriginalName();
     // apply md5 function to generate an unique identifier for the file and concat it with the file extension  
           try {
               $file2->move(
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
      $id_2 = $Row['A']; 
      $nota11 = $Row['C']; 
      $descripcion11 = $Row['D']; 
      $nota12 = $Row['E'];
      $descripcion12 = $Row['F']; 
      $nota13 = $Row['G']; 
      $descripcion13 = $Row['H']; 
      $nota14 = $Row['I']; 
      $descripcion14 = $Row['J'];
      $nota15 = $Row['K']; 
      $descripcion15 = $Row['L'];
      $notas_2 = $entityManager->getRepository(Notas::class)->findOneBy(array('id' => $id_2));
      $notas_2->setNota11($nota11);
      $notas_2->setNota11Descripcion($descripcion11);
      $notas_2->setNota12($nota12);
      $notas_2->setNota12Descripcion($descripcion12);
      $notas_2->setNota13($nota13);
      $notas_2->setNota13Descripcion($descripcion13);
      $notas_2->setNota14($nota14);
      $notas_2->setNota14Descripcion($descripcion14);
      $notas_2->setNota15($nota15);
      $notas_2->setNota15Descripcion($descripcion15);
      $entityManager->persist($notas_2);
      $entityManager->flush();
     
      

   }
   return $this->redirect($request->getUri()); 
}
        return $this->render('materia/paralelo_stundet.html.twig', [

            'form' => $form->createView(),
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
            'materias'=> $materia,
            'paralelo'=>$paralelo,
            'notas1'=>$h,
            'notas2'=>$g,
            'parcial1'=>$parcial1,
            'parcial2'=>$parcial2,
            'parcial3'=>$parcial3,
            'periodos'=>$periodoRepository->periodo_academico(),
        ]);
    }


 
    
    /**
     * @Route("/{id}/materia_stundet4", name="materia_stundet4", methods={"GET","POST"})
     */
    public function materia_stundet4(Request $request,$id): Response
    {
        
      
        $em= $this->getDoctrine()->getManager();
        $materia= $em->getRepository(Materia::class)->find($id);
        $h= $em->getRepository(Notas::class)-> materia_st2($materia->getId());
        return $this->render('materia/materia_stundet4.html.twig', [
            'materias'=> $materia,
            'notas'=>$h

        ]);
    }





    /**
     * @Route("/{id}/edit", name="materia_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_PROFESOR') or is_granted('ROLE_SECRETARIA')")
     */
    public function edit(Request $request, Materia $materium): Response
    {
        $form = $this->createForm(MateriaType::class, $materium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materia_index');
        }

        return $this->render('materia/edit.html.twig', [
            'materium' => $materium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="materia_delete", methods={"DELETE","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function delete(Request $request, Materia $materium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($materium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('materia_index');
    }
}
