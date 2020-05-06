<?php

namespace App\Mailer;

use App\Entity\Token;
use App\Entity\User;
use App\Mailer\Interfaces\RegistrationMailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class RegistrationMailer implements RegistrationMailerInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->setMailer($mailer);
    }

    public function sendEmail(User $user, Token $token)
    {
        $email = (new TemplatedEmail())
            ->from('info@snowtricks.com')
            ->to($user->getEmail())
            ->subject('Bienvenue dans la communauté de SnowTricks !')
            ->htmlTemplate('emails/registration.html.twig')
            ->context([
                'token' => $token,
                'user' => $user,
            ]);

        return $this->getMailer()->send($email);
    }

    /**
     * @return MailerInterface
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * @param MailerInterface $mailer
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;
    }
}
