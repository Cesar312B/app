<?php

namespace App\Controller;

use App\Entity\AuditoriaMatricula;
use App\Entity\AuditoriaStudent;
use App\Repository\AuditoriaMatriculaRepository;
use App\Repository\AuditoriaStudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class InicioController extends AbstractController
{
    /**
     * @Route("/", name="inicio")
     */
    public function index(): Response
    {

        if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('notas_student');
        }elseif ($this->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirectToRoute('welcom');
        
                }elseif ($this->isGranted('ROLE_PROFESOR')) {
                    return $this->redirectToRoute('welcom');
                
                        }elseif ($this->isGranted('ROLE_SECRETARIA')) {
                            return $this->redirectToRoute('welcom');
                        
                                }                      
                
                return $this->render('inicio/index.html.twig', [
            'controller_name' => 'InicioController',
        ]);
    }




    /**
     * @Route("/welcom", name="welcom")
     * @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_PROFESOR') or is_granted('ROLE_SECRETARIA')")
     */
    public function welcom(): Response
    {
            return $this->render('inicio/welcom.html.twig', [
            'controller_name' => 'InicioController',
        ]);
    }

     /**
     * @Route("/audit", name="auditoria")
     * @IsGranted("ROLE_SUPER_ADMIN",message="No tiene acceso a esta pagina")
     */
    public function auditorias(AuditoriaStudentRepository $auditoriaStudentRepository,AuditoriaMatriculaRepository $auditoriaMatriculaRepository): Response
    {
            return $this->render('inicio/auditoria.html.twig', [
            'student' =>$auditoriaStudentRepository->findAll() ,
            'matricula'=>$auditoriaMatriculaRepository->matricula(),
        ]);
    }
}