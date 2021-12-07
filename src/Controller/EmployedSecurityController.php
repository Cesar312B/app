<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class EmployedSecurityController extends AbstractController
{
    /**
     * @Route("/employed_login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        
     
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirectToRoute('welcom');
        
                }elseif ($this->isGranted('ROLE_PROFESOR')) {
                    return $this->redirectToRoute('welcom');
                
                        }elseif ($this->isGranted('ROLE_SECRETARIA')) {
                            return $this->redirectToRoute('welcom');
                        
                                }   
        // if ($this->getUser()) {
        //    
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/employed_login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
