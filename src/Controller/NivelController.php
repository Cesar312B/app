<?php

namespace App\Controller;

use App\Entity\Nivel;
use App\Form\NivelType;
use App\Repository\NivelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/nivel")
 *
 */
class NivelController extends AbstractController
{
    /**
     * @Route("/", name="nivel_index", methods={"GET"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function index(NivelRepository $nivelRepository): Response
    {
        return $this->render('nivel/index.html.twig', [
            'nivels' => $nivelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nivel_new", methods={"GET","POST"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function new(Request $request): Response
    {
        $nivel = new Nivel();
        $form = $this->createForm(NivelType::class, $nivel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nivel);
            $entityManager->flush();

            return $this->redirectToRoute('nivel_index');
        }

        return $this->render('nivel/new.html.twig', [
            'nivel' => $nivel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nivel_show", methods={"GET"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function show(Nivel $nivel): Response
    {
        return $this->render('nivel/show.html.twig', [
            'nivel' => $nivel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nivel_edit", methods={"GET","POST"})
     *@Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function edit(Request $request, Nivel $nivel): Response
    {
        $form = $this->createForm(NivelType::class, $nivel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nivel_index');
        }

        return $this->render('nivel/edit.html.twig', [
            'nivel' => $nivel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nivel_delete", methods={"DELETE","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function delete(Request $request, Nivel $nivel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nivel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nivel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nivel_index');
    }
}
