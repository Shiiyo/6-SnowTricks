<?php

namespace App\Mailer\Interfaces;

use App\Entity\Token;
use App\Entity\User;

interface RegistrationMailerInterface
{
    /**
     * @param User $user
     * @param Token $token
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(User $user, Token $token);
}