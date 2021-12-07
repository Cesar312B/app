<?php
namespace App\Security;

use App\Entity\Employed as AppUser;
use App\Entity\Student as AppStudent;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof AppUser & !$user instanceof AppStudent ) {
            return;
        }

        if ($user->getIsActive() == false) {
          
            // the message passed to this exception is meant to be displayed to the user
            throw new CustomUserMessageAccountStatusException('Tu cuenta esta bloqueada.');
        }

        
       
    }



    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof AppUser) {
            return;
        }

    
        if ($user->getIsActive() == false ) {
        
        }


    }


   
}