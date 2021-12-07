<?php

namespace App\Controller;

use App\Entity\Materia;
use App\Entity\Paralelo;
use App\Form\ParaleloType_edit;
use App\Repository\ParaleloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/paralelo")
 */
class ParaleloController extends AbstractController
{
    /**
     * @Route("/", name="paralelo_index", methods={"GET"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function index(ParaleloRepository $paraleloRepository): Response
    {
        return $this->render('paralelo/index.html.twig', [
            'paralelos' => $paraleloRepository->findAll(),
        ]);
    }



    /**
     * @Route("/{id}/new", name="paralelo_new", methods={"GET","POST"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function new(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $paralelo = new Paralelo();
        $materia= $entityManager->getRepository(Materia::class)->find($id);
        $form = $this->createForm(ParaleloType_edit::class, $paralelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paralelo->setMateria($materia);
            $entityManager->persist($paralelo);
            $entityManager->flush();
            $this->addFlash('exito', 'Creado con exito');
            return $this->redirect($request->getUri());
        }

        return $this->render('paralelo/new.html.twig', [
            'paralelo' => $paralelo,
            'materia'=>$materia,
            'form' => $form->createView(),
        ]);
    }



     /**
     * @Route("/{id}/mat/{m}", name="paralelo_edit", methods={"GET","POST"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function edit(Request $request, Paralelo $paralelo,$m): Response
    {
        $em= $this->getDoctrine()->getManager();
        $materia= $em->getRepository(Materia::class)->find($m);
        $form = $this->createForm(ParaleloType_edit::class, $paralelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito', 'Actualizado con exito');
            return $this->redirect($request->getUri());
        }

        return $this->render('paralelo/edit.html.twig', [
            'paralelo' => $paralelo,
            'materia'=>$materia,
            'form' => $form->createView(),
        ]);
    }


     /**
     * @Route("/{id}", name="paralelo_show", methods={"GET"})
     */
    public function show(Paralelo $paralelo): Response
    {
        
        return $this->render('paralelo/show.html.twig', [
            'paralelo' => $paralelo,
        ]);
    }



    
    /**
     * @Route("/{id}", name="paralelo_delete", methods={"DELETE","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function delete(Request $request, Paralelo $paralelo): Response
    {
       
        if ($this->isCsrfTokenValid('delete'.$paralelo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($paralelo);
            $entityManager->flush();
        }
        return $this->redirectToRoute('materia_index');

        
    }
}
