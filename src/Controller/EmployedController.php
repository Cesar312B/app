<?php

namespace App\Controller;

use App\Entity\Employed;

use App\Entity\Paralelo;
use App\Form\EmployedType;
use App\Form\ParaleloType;
use App\Repository\EmployedRepository;
use App\Repository\ParaleloRepository;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * @Route("/employed")
 *
 */
class EmployedController extends AbstractController
{
    /**
     * @Route("/", name="employed_index", methods={"GET"})
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
     */
    public function index(EmployedRepository $employedRepository): Response
    {
           $em = $this->getDoctrine()->getManager();
           $qb = $em->createQueryBuilder();
          $qb->select('u') ->from(Employed::class, 'u') ->where('u.roles LIKE :roles') 
          ->orWhere('u.roles LIKE :role')
          ->setParameter('roles', '%"'."ROLE_PROFESOR".'"%')
          ->setParameter('role', '%"'."ROLE_SECRETARIA".'"%')
          ;
          
         $users = $qb->getQuery()->getResult();
        return $this->render('employed/index.html.twig', [
            'employeds' => $users
        ]);
    }

    /**
     * @Route("/new", name="employed_new", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function new(Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $employed = new Employed();
        $form = $this->createForm(EmployedType::class, $employed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file= $request->files->get('employed')['foto'];
            if ($file) {
         
            $filname= md5(uniqid()) .'.'. $file->guessExtension();
                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('fotos_directory'),
                        $filname
                    );
                } catch (FileException $e) {
                    throw  new \Exception('Error al subir archivos');
                    // ... handle exception if something happens during file upload
                }
                  $employed->setFoto($filname);
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
               
            }
            
           


            $employed->setUsername($form['Cedula']->getData());
            $employed->setPassword($passwordEncoder->encodePassword( $employed,$form['Cedula']->getData()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employed);
            $entityManager->flush();

            return $this->redirectToRoute('employed_index');
        }

        return $this->render('employed/new.html.twig', [
            'employed' => $employed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="employed_show")
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_SECRETARIA')")
    
     */
    public function show($id,Request $request, ParaleloRepository $paraleloRepository)
    {
        $em= $this->getDoctrine()->getManager();
        $paralelo= new Paralelo();
        $emp= $em->getRepository(Employed::class)->find($id);
        $pt= $paraleloRepository->tc_paralelo($emp->getId());
        $form= $this->createForm(ParaleloType::class ,$paralelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paralelo->setEmployed($emp);
            $em->persist($paralelo);
            $em->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('employed/show.html.twig', [
            'form'=>$form->createView(),
            'emp' => $emp,
            'paralelo'=>$pt
    

        ]);
    }

    
     


  


    /**
     * @Route("/{id}/edit", name="employed_edit", methods={"GET","POST"})
     *@IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function edit(Request $request, Employed $employed ,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(EmployedType::class, $employed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file= $request->files->get('employed')['foto'];
            if ($file) {
         
            $filname= md5(uniqid()) .'.'. $file->guessExtension();
                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('fotos_directory'),
                        $filname
                    );
                } catch (FileException $e) {
                    throw  new \Exception('Error al subir archivos');
                    // ... handle exception if something happens during file upload
                }
                  $employed->setFoto($filname);
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
               
            }
            $employed->setUsername($form['Cedula']->getData());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employed_index');
        }

        return $this->render('employed/edit.html.twig', [
            'employed' => $employed,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("delete/{id}", name="employed_delete", methods={"DELETE","POST"})
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function delete(Request $request, Employed $employed): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employed->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employed_index');
    }
}
