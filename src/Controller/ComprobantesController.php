<?php

namespace App\Controller;

use App\Entity\Comprobantes;
use App\Entity\Modulos;
use App\Form\ComprobantesType;
use App\Repository\ComprobantesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/comprobantes")
 * @IsGranted("ROLE_USER",message="No tiene acceso a esta pagina")
 */
class ComprobantesController extends AbstractController
{
    /**
     * @Route("/", name="comprobantes_index", methods={"GET","POST"})
     */
    public function index(ComprobantesRepository $comprobantesRepository,Request $request): Response
    {
        $em= $this->getDoctrine()->getManager();
         
        $repository = $this->getDoctrine()->getRepository(Modulos::class);

        $perfil= $repository->findOneBy([
            'nombre' => 'Comprobantes',
        ]);

        
        $student= $this->getUser();
        $comprobante = new Comprobantes();
        $form = $this->createForm(ComprobantesType::class, $comprobante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $file1= $request->files->get('comprobantes')['archivo'];


            if ($file1) {
         
                $filname= md5(uniqid()) .'.'. $file1->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $file1->move(
                            $this->getParameter('comprobantes_directory'),
                            $filname
                        );
                    } catch (FileException $e) {
                        throw  new \Exception('Error al subir archivo');
                        // ... handle exception if something happens during file upload
                    }
                     $comprobante->setArchivo($filname);
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                   
                }
            $comprobante->setStudent($student);
            $entityManager->persist($comprobante);
            $entityManager->flush();

            return $this->redirect($request->getUri());
        }
        return $this->render('comprobantes/index.html.twig', [
            'modulo'=>$perfil,
            'comprobantes' => $comprobantesRepository->findBy(['student'=>$student]),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="comprobantes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comprobante = new Comprobantes();
        $form = $this->createForm(ComprobantesType::class, $comprobante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
              $file1= $request->files->get('comprobantes')['archivo'];


            if ($file1) {
         
                $filname= md5(uniqid()) .'.'. $file1->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $file1->move(
                            $this->getParameter('comprobantes_directory'),
                            $filname
                        );
                    } catch (FileException $e) {
                        throw  new \Exception('Error al subir archivo');
                        // ... handle exception if something happens during file upload
                    }
                     $comprobante->setArchivo($filname);
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                   
                }
                
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comprobante);
            $entityManager->flush();

            return $this->redirectToRoute('comprobantes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comprobantes/new.html.twig', [
            'comprobante' => $comprobante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comprobantes_show", methods={"GET"})
     */
    public function show(Comprobantes $comprobante): Response
    {
        return $this->render('comprobantes/show.html.twig', [
            'comprobante' => $comprobante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comprobantes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comprobantes $comprobante): Response
    {
        $form = $this->createForm(ComprobantesType::class, $comprobante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
              $file1= $request->files->get('comprobantes')['archivo'];


            if ($file1) {
         
                $filname= md5(uniqid()) .'.'. $file1->guessExtension();
                    // Move the file to the directory where brochures are stored
                    try {
                        $file1->move(
                            $this->getParameter('comprobantes_directory'),
                            $filname
                        );
                    } catch (FileException $e) {
                        throw  new \Exception('Error al subir archivo');
                        // ... handle exception if something happens during file upload
                    }
                     $comprobante->setArchivo($filname);
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                   
                }
                
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comprobantes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comprobantes/edit.html.twig', [
            'comprobante' => $comprobante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comprobantes_delete", methods={"POST"})
     */
    public function delete(Request $request, Comprobantes $comprobante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comprobante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comprobante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comprobantes_index', [], Response::HTTP_SEE_OTHER);
    }
}
