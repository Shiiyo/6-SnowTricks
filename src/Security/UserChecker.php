<?php

namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        if (!$user->getIsActive()) {
            throw new Exception('Votre compte n\'est pas actif, merci de vérifier votre adresse email avant de vous connecter');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        if (!$user->getIsActive()) {
            throw new Exception('Votre compte n\'est pas actif, merci de vérifier votre adresse email avant de vous connecter');
        }
    }
}
