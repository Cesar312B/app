<?php

namespace App\Controller;

use App\Entity\Carrera;
use App\Form\CarreraType;
use App\Repository\CarreraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/carrera")
 * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
 */
class CarreraController extends AbstractController
{

  
    
    /**
     * @Route("/", name="carrera_index", methods={"GET"})
     */
    public function index(CarreraRepository $carreraRepository): Response
    {
        return $this->render('carrera/index.html.twig', [
            'carreras' => $carreraRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="carrera_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carrera = new Carrera();
        $form = $this->createForm(CarreraType::class, $carrera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carrera);
            $entityManager->flush();

            return $this->redirectToRoute('carrera_index');
        }

        return $this->render('carrera/new.html.twig', [
            'carrera' => $carrera,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carrera_show", methods={"GET"}   )
     */
    public function show(Carrera $carrera): Response
    {
        
        return $this->render('carrera/show.html.twig', [
            'carrera' => $carrera,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carrera_edit", methods={"GET","POST"})
     * 
     */
    public function edit(Request $request, Carrera $carrera ): Response
    {
       
       
        $form = $this->createForm(CarreraType::class, $carrera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carrera_index');
        }

        return $this->render('carrera/edit.html.twig', [
            'carrera' => $carrera,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carrera_delete", methods={"DELETE","POST"})
     */
    public function delete(Request $request, Carrera $carrera): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carrera->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carrera);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carrera_index');
    }
}
