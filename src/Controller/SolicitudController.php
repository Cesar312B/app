<?php

namespace App\Controller;

use App\Entity\Modulos;
use App\Entity\Solicitud;
use App\Form\SolicitudType;
use App\Repository\SolicitudRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/solicitud")
 * @IsGranted("ROLE_USER",message="No tiene acceso a esta pagina")
 */
class SolicitudController extends AbstractController
{
    /**
     * @Route("/", name="solicitud_index", methods={"GET","POST"})
     */
    public function index(SolicitudRepository $solicitudRepository,Request $request): Response
    {
        $em= $this->getDoctrine()->getManager();
         
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $perfil= $repository->findOneBy([
            'nombre' => 'Solicitudes',
        ]);

         
      
        $student= $this->getUser();
        $solicitud = new Solicitud();
        $form = $this->createForm(SolicitudType::class, $solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file1= $request->files->get('solicitud')['archivo'];


            if ($file1) {
         
                $filname= md5(uniqid()) .'.'. $file1->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $file1->move(
                            $this->getParameter('solicitud_directory'),
                            $filname
                        );
                    } catch (FileException $e) {
                        throw  new \Exception('Error al subir archivo');
                        // ... handle exception if something happens during file upload
                    }
                     $solicitud->setArchivo($filname);
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                   
                }
            $entityManager = $this->getDoctrine()->getManager();
            $solicitud->setStudent($student);
            $entityManager->persist($solicitud);
            $entityManager->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('solicitud/index.html.twig', [
            'modulo'=>$perfil,
            'solicituds' => $solicitudRepository->findBy(['student'=>$student]),
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @Route("/new", name="solicitud_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $solicitud = new Solicitud();
        $form = $this->createForm(SolicitudType::class, $solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($solicitud);
            $entityManager->flush();

            return $this->redirectToRoute('solicitud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('solicitud/new.html.twig', [
            'solicitud' => $solicitud,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solicitud_show", methods={"GET"})
     */
    public function show(Solicitud $solicitud): Response
    {
        return $this->render('solicitud/show.html.twig', [
            'solicitud' => $solicitud,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="solicitud_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Solicitud $solicitud): Response
    {
        $form = $this->createForm(SolicitudType::class, $solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $file1= $request->files->get('solicitud')['archivo'];

            if ($file1) {
         
                $filname= md5(uniqid()) .'.'. $file1->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $file1->move(
                            $this->getParameter('solicitud_directory'),
                            $filname
                        );
                    } catch (FileException $e) {
                        throw  new \Exception('Error al subir archivo');
                        // ... handle exception if something happens during file upload
                    }
                     $solicitud->setArchivo($filname);
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                   
                }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('solicitud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('solicitud/edit.html.twig', [
            'solicitud' => $solicitud,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solicitud_delete", methods={"POST"})
     */
    public function delete(Request $request, Solicitud $solicitud): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solicitud->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($solicitud);
            $entityManager->flush();
        }

        return $this->redirectToRoute('solicitud_index', [], Response::HTTP_SEE_OTHER);
    }
}
