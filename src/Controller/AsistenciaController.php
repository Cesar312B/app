<?php

namespace App\Controller;

use App\Entity\Asistencia;
use App\Entity\Materia;
use App\Form\AsistenciaType;
use App\Entity\Student;
use App\Repository\AsistenciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Paralelo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * @Route("/asistencia")
 */
class AsistenciaController extends AbstractController
{
    /**
     * @Route("/", name="asistencia_index", methods={"GET"})
     *  @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function index(AsistenciaRepository $asistenciaRepository): Response
    {
        return $this->render('asistencia/index.html.twig', [
            'asistencias' => $asistenciaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/asistencia_profesor", name="asistencia_profesor", methods={"GET"})
     */
    public function asistencia_profesor(AsistenciaRepository $asistenciaRepository): Response
    {

         
        $employed= $this->getUser();

        return $this->render('asistencia/asistencia_profesor.html.twig', [
            'asistencias' => $asistenciaRepository->Asistencia3($employed->getId()),
        ]);
    }



      /**
     * @Route("/faltas_student", name="faltas_student", methods={"GET"})
     *  @IsGranted("ROLE_USER",message="No tiene acceso a esta pagina")
     */
    public function faltas_student(AsistenciaRepository $asistenciaRepository): Response
    {

        $student= $this->getUser();
        $em= $this->getDoctrine()->getManager();
        $faltas = $em->getRepository(Asistencia::class)->Asistencia1($student->getId()); 
        $faltas1 = $em->getRepository(Asistencia::class)->Asistencia2($student->getId()); 
        return $this->render('asistencia/faltas_student.html.twig', [
            'asistencias' => $faltas,
            'asistencia' => $faltas1,
        ]);
    }


    /**
     * @Route("/new", name="asistencia_new", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function new(Request $request): Response
    {
        $asistencium = new Asistencia();
        $form = $this->createForm(AsistenciaType::class, $asistencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($asistencium);
            $entityManager->flush();

            return $this->redirectToRoute('asistencia_index');
        }

        return $this->render('asistencia/new.html.twig', [
            'asistencium' => $asistencium,
            'form' => $form->createView(),
        ]);
    }

   
    

    /**
     * @Route("/ast/{id}/paralelo/{p}/mat/{m}",name="ast")
     * @IsGranted("ROLE_PROFESOR",message="No tiene acceso a esta pagina")
     */
    public function aistencia($id,$p,$m,Request $request,AsistenciaRepository $asistenciaRepository)
    {
        $asistencia = new Asistencia();
        $em= $this->getDoctrine()->getManager();
        $stu= $em->getRepository(Student::class)->find($id);
        $paralelo= $em->getRepository(Paralelo::class)->find($p);
        $materia= $em->getRepository(Materia::class)->find($m);
        
        $ast= $asistenciaRepository->Asistencia3($stu->getId(),$paralelo->getId());
        $form = $this->createForm(AsistenciaType::class, $asistencia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
    
            $asistencia->setStudent($stu);
            $asistencia->setParalelo($paralelo);
            $em->persist($asistencia);
            $em->flush();

            return $this->redirect($request->getUri());
        }
        return $this->render('asistencia/asistencia.html.twig', [
            'form'=>$form->createView(),
            'materia'=>$materia,
            'ast' => $stu,
            'par'=>$paralelo,
            'atp'=>$ast
        
        ]);
    }




  

    /**
     * @Route("/{id}/edit", name="asistencia_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function edit(Request $request, Asistencia $asistencium): Response
    {
        $form = $this->createForm(AsistenciaType::class, $asistencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asistencia_index');
        }

        return $this->render('asistencia/edit.html.twig', [
            'asistencium' => $asistencium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     * @Route("/{id}", name="delate_asistencia", methods={"DELETE"})
     */
    public function delete(Request $request, $id) {

        $asistencia= $this->getDoctrine()->getRepository(Asistencia::class)->find($id);
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($asistencia);
          $entityManager->flush();
          $response = new Response();
          $response->send();
        }
    

  
}
