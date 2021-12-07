<?php

namespace App\Controller;

use App\Entity\Modulos;
use App\Form\ModulosType;
use App\Repository\ModulosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/modulos")
 * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
 */
class ModulosController extends AbstractController
{
    /**
     * @Route("/", name="modulos_index", methods={"GET"})
     */
    public function index(ModulosRepository $modulosRepository): Response
    {
        return $this->render('modulos/index.html.twig', [
            'modulos' => $modulosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="modulos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $modulo = new Modulos();
        $form = $this->createForm(ModulosType::class, $modulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modulo);
            $entityManager->flush();

            return $this->redirectToRoute('modulos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modulos/new.html.twig', [
            'modulo' => $modulo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="modulos_show", methods={"GET"})
     */
    public function show(Modulos $modulo): Response
    {
        return $this->render('modulos/show.html.twig', [
            'modulo' => $modulo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="modulos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Modulos $modulo): Response
    {
        $form = $this->createForm(ModulosType::class, $modulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modulos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modulos/edit.html.twig', [
            'modulo' => $modulo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="modulos_delete", methods={"POST"})
     */
    public function delete(Request $request, Modulos $modulo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modulo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modulo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('modulos_index', [], Response::HTTP_SEE_OTHER);
    }
}
