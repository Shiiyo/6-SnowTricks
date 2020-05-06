<?php

namespace App\Mailer\Interfaces;

use App\Entity\Token;
use App\Entity\User;

interface RegistrationMailerInterface
{
    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(User $user, Token $token);
}
