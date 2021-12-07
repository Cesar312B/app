<?php

namespace App\Controller;

use App\Entity\Horario;
use App\Entity\Materia;
use App\Entity\Paralelo;
use App\Form\HorarioType;
use App\Repository\HorarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/horario")
 */
class HorarioController extends AbstractController
{
    /**
     * @Route("/h_st", name="h_estudent", methods={"GET"})
     * @IsGranted("ROLE_USER",message="No tiene acceso a esta pagina")
     */
    public function index(HorarioRepository $horarioRepository): Response
    {

        $student= $this->getUser();
        return $this->render('horario/index.html.twig', [
            
            'l' => $horarioRepository->h_student($student->getId()),
            'm' => $horarioRepository->h_student2($student->getId()),
            'mt' => $horarioRepository->h_student3($student->getId()),
            'j' => $horarioRepository->h_student4($student->getId()),
            'v' => $horarioRepository->h_student5($student->getId()),
            's' => $horarioRepository->h_student6($student->getId()),

        ]);
    }


     /**
     * @Route("/h_em", name="h_employed", methods={"GET"})
     * @IsGranted("ROLE_PROFESOR",message="No tene acceso a esta pagina")
     */
    public function index2(HorarioRepository $horarioRepository): Response
    {

        $employed= $this->getUser();
        return $this->render('horario/h_emp.html.twig', [
            
            'l' => $horarioRepository->h_teacher($employed->getId()),
            'm' => $horarioRepository->h_teacher2($employed->getId()),
            'mt' => $horarioRepository->h_teacher3($employed->getId()),
            'j' => $horarioRepository->h_teacher4($employed->getId()),
            'v' => $horarioRepository->h_teacher5($employed->getId()),
            's' => $horarioRepository->h_teacher6($employed->getId()),

        ]);
    }

    /**
     * @Route("/new", name="horario_new", methods={"GET","POST"})
     * 
     */
    public function new(Request $request): Response
    {
        $horario = new Horario();
        $form = $this->createForm(HorarioType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horario);
            $entityManager->flush();

            return $this->redirectToRoute('horario_index');
        }

        return $this->render('horario/new.html.twig', [
            'horario' => $horario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/shownota", name="horario_show", methods={"GET"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function show(Horario $horario): Response
    {
        return $this->render('horario/show.html.twig', [
            'horario' => $horario,
        ]);
    }

    /**
     *@Route("/{id}/paralelo/{p}/materia/{m}", name="horario_edit", methods={"GET","POST"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function edit(Request $request, Horario $horario,$p,$m): Response
    {
        $em= $this->getDoctrine()->getManager();
        $paralelo= $em->getRepository(Paralelo::class)->find($p);
        $materia= $em->getRepository(Materia::class)->find($m);
        $form = $this->createForm(HorarioType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito', 'Editado con exito');
            return $this->redirect($request->getUri());
        }

        return $this->render('horario/edit.html.twig', [
            'p'=>$paralelo,
            'm'=>$materia,
            'h' => $horario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete_horario", methods={"DELETE"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function delete(Request $request, Horario $horario,$id)
    {
        $horario= $this->getDoctrine()->getRepository(Horario::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($horario);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();
    }
}
