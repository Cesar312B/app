<?php

namespace App\Controller;

use App\Entity\Asistencia;
use App\Entity\AuditoriaMatricula;
use App\Entity\AuditoriaStudent;
use App\Entity\Modulos;
use App\Form\NotasType;
use App\Entity\Notas;
use App\Entity\Student;
use App\Form\StudentDocumentType;
use App\Form\StudenteditType;
use App\Form\StudentType;
use App\Repository\ComprobantesRepository;
use App\Repository\PeriodoRepository;
use App\Repository\SolicitudRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/", name="student_index", methods={"GET","POST"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function index(StudentRepository $studentRepository,Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
       
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $modulo = $repository->findOneBy([
            'nombre' => 'Matricula',
        ]);
      /*
        $form =$this->createFormBuilder()
        ->add('file',FileType::class,[
            'label'=> 'Archivo Exel.(xlsx)',
            'mapped' => false,
            'required' => true,
        ])
        ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
        $file= ($form['file']->getData()); // get the file from the sent request
   
        $fileFolder = __DIR__ . '/../../public/exels/';  //choose the folder in which the uploaded file will be stored
  
        $filePathName= md5(uniqid()) .'.'. $file->getClientOriginalName();
      // apply md5 function to generate an unique identifier for the file and concat it with the file extension  
            try {
                $file->move($fileFolder, $filePathName);
            } catch (FileException $e) {
                throw  new \Exception('Error al subir archivo');
            }
         $spreadsheet = IOFactory::load($fileFolder . $filePathName); // Here we are able to read from the excel file 
         $row = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
         $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array
         //dd($sheetData);

         $entityManager = $this->getDoctrine()->getManager(); 
        
         foreach ($sheetData as $Row) 
             { 


     
                 $id = $Row['A']; // store the first_name on each iteration 
                 $id1 = $Row['H'];
                 $id2 = $Row['I'];
                 $id3 = $Row['J'];
                 $id4 = $Row['K'];
                 $id5 = $Row['L'];
                 $id6 = $Row['M'];
                 $id7 = $Row['N'];
                 $id8 = $Row['O'];
                 $id9 = $Row['P'];
                 $id10 = $Row['Q'];
                 $id11 = $Row['R'];
                 $id12 = $Row['S'];
                 $id13 = $Row['T'];
                 $id14 = $Row['U'];
                 $id15 = $Row['V'];
                 $id16 = $Row['W'];
                 $id17 = $Row['X'];
                 $id18 = $Row['Y'];
                 $id19 = $Row['Z'];
                 $id20 = $Row['AA'];
                 $id21 = $Row['AB'];
                 $id22 = $Row['AC'];
                 $id23 = $Row['AD'];
                 $id24= $Row['AE'];
                 $id25 = $Row['AF'];
                 $id26 = $Row['AG'];
                 $id27 = $Row['AH'];
                 $id28 = $Row['AI'];
                 $id29 = $Row['AJ'];
                 $id30 = $Row['AK'];
                 $id31 = $Row['AL'];
                    $student = $entityManager->getRepository(Student::class)->findOneBy(array('id' => $id));
                     $student->setTipoIdentificacion($id1);
                     $student->setSexo($id2);
                     $student->setCorreo($id3);
                     $student->setNConvencional($id4);
                     $student->setDireccion($id5);
                     $student->setCodigoPostal($id6);
                     $student->setContacto($id7);
                     $student->setParentesco($id8);
                     $student->setNContacto($id9);
                     $student->setEtnia($id10);
                     $student->setIdiomaAncestral($id11);
                     $student->setTipoSangre($id13);
                     $student->setCategoriaMogratoria($id14);
                     $student->setPaisRidencia($id15);
                     $student->setProvinciaRecidencia($id16);
                     $student->setEstadoCivil($id17);
                     $student->setDiscapacidad($id18);
                     $student->setTipoColegio($id19);
                     $student->setTipoBachillerato($id20);
                     $student->setTituloSuperior($id21);
                     $student->setMotivoIngresos($id22);
                     $student->setFormacionPadre($id23);
                     $student->setFormacionMadre($id24);
                     $student->setNMiembrosfamilia($id25);
                     $student->setBonoHumano($id26);
                     $student->setIngresosHogar($id27);
                     $student->setRepetdoMateria($id28);
                     $student->setPerdidaGratuidad($id29);
                     $student->setEstdoLaboral($id30);
                     $student->setSectorEconomicoLaboral($id31);
                     $entityManager->persist($student); 
                     $entityManager->flush(); 
                  
             } 
         

        return $this->redirect($request->getUri()); 
    }*/
         
        return $this->render('student/index.html.twig', [
            'students' => $studentRepository->findAll(),
            'modulo'=>$modulo,
          
        ]);
        
    }

    /**
     * @Route("/new_student", name="new_student", methods={"GET","POST"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function new(Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
       
        $employed= $this->getUser();
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $student->setUsername($form['Cedula']->getData());
            $student->setPassword($passwordEncoder->encodePassword( $student,$form['Cedula']->getData()));
            $entityManager = $this->getDoctrine()->getManager();
            $auditoria= new AuditoriaStudent();
            $auditoria->setEmployed($employed);
            $auditoria->setNombre($form['Nombre']->getData());
            $auditoria->setApellido($form['Apellido']->getData());
            $auditoria->setCedula($form['Cedula']->getData());
            $auditoria->setAccion('Registro');
            $entityManager->persist($student);
            $entityManager->persist($auditoria);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }

     
  
        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show")
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function show($id,Request $request,ComprobantesRepository $comprobantesRepository, SolicitudRepository $solicitudRepository,PeriodoRepository $periodoRepository)
    {
        $employed= $this->getUser();

        $em= $this->getDoctrine()->getManager(); 
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $perfil= $repository->findOneBy([
            'nombre' => 'Matricula',
        ]);

        
       
        $nota= new Notas();
        $stu=$em->getRepository(Student::class)->find($id);
        $notas=$em->getRepository(Notas::class)->Record($stu->getId()); 
        $notas2=$em->getRepository(Notas::class)->BuscarNotas($stu->getId()); 

        $form = $this->createForm(NotasType::class, $nota);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $nota->setEmployed($employed);
            $nota->setStudent($stu);
            $auditoria= new AuditoriaMatricula();
            $auditoria->setEmployed($employed);
            $auditoria->setAccion('Registro');
         
            $em->persist($auditoria);
            $em->persist($nota);
            $em->flush();
         return $this->redirect($request->getUri());
        }
        return $this->render('student/show.html.twig', [
            'solicituds' => $solicitudRepository->findBy(['student'=>$stu]),
            'comprobantes' => $comprobantesRepository->findBy(['student'=>$stu]), 
            'form'=>$form->createView(),
            'student' => $stu,
            'notas' => $notas,
            'n'=>$notas2,
            'modulo'=>$perfil,
            'periodos'=>$periodoRepository->periodo_academico(),

        ]);
    }

    /**
     * @Route("/{id}/asistencia_show", name="asistencia_show", methods={"GET"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function show_faltas($id)
    { 
        $em= $this->getDoctrine()->getManager();
        $student= $this->getDoctrine()->getRepository(Student::class)->find($id);
        $faltas2=$em->getRepository(Asistencia::class)->Asistencia2($student->getId()); 
        $faltas = $em->getRepository(Asistencia::class)->Asistencia1($student->getId()); 
        return $this->render('student/asistencia_show.html.twig', [
            'student'=>$student,
            'faltas' => $faltas,
            'faltas2'=>$faltas2
        ]);
    }
 


    /**
     * @Route("/{id}/edit", name="student_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function edit(Request $request, Student $student, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $employed= $this->getUser();
        $form = $this->createForm(StudenteditType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

         
            $student->setUsername($form['Cedula']->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $auditoria= new AuditoriaStudent();
            $auditoria->setEmployed($employed);
            $auditoria->setNombre($form['Nombre']->getData());
            $auditoria->setApellido($form['Apellido']->getData());
            $auditoria->setCedula($form['Cedula']->getData());
            $auditoria->setAccion('Edito');
            $entityManager->persist($auditoria);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }


    
    /**
     * @Route("/{id}/documentos", name="doct", methods={"GET","POST"})
     * @IsGranted("ROLE_USER",message="No tiene acceso a esta pagina")
     */
    public function document(Request $request, Student $id): Response
    {
        $em= $this->getDoctrine()->getManager();
         
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $perfil= $repository->findOneBy([
            'nombre' => 'Perfil',
        ]);

        
        $st= new Student();
        $st = $this->getDoctrine()->getRepository(Student::class)->find($id);
      
        $form = $this->createForm(StudentDocumentType::class, $st);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file= ($form['foto']->getData());


            if ($file) {
         
                $filname= md5(uniqid()) .'.'. $file->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $file->move(
                            $this->getParameter('fotos_directory'),
                            $filname
                        );
                    } catch (FileException $e) {
                        throw  new \Exception('Error al subir archivo');
                        // ... handle exception if something happens during file upload
                    }
                     $st->setFoto($filname);
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                   
                }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect($request->getUri());
        }

        return $this->render('student/document.html.twig', [
            'modulo'=>$perfil,
            'student' => $st,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("delete/{id}", name="student_delete", methods={"DELETE","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function delete(Request $request, Student $student): Response
    {
        $employed= $this->getUser();
        $form = $this->createForm(StudenteditType::class, $student);
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $auditoria= new AuditoriaStudent();
            $auditoria->setEmployed($employed);
            $auditoria->setNombre($form['Nombre']->getData());
            $auditoria->setApellido($form['Apellido']->getData());
            $auditoria->setCedula($form['Cedula']->getData());
            $auditoria->setAccion('Elimino');
            $entityManager->remove($student);
            $entityManager->persist($auditoria);
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_index');
    }
}
