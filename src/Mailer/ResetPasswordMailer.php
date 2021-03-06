<?php

namespace App\Mailer;

use App\Entity\Token;
use App\Entity\User;
use App\Mailer\Interfaces\ResetPasswordMailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ResetPasswordMailer implements ResetPasswordMailerInterface
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->setMailer($mailer);
    }

    public function sendEmail(User $user, Token $token)
    {
        $email = (new TemplatedEmail())
            ->from('info@snowtricks.com')
            ->to($user->getEmail())
            ->subject('Vous avez demandé à réinitialiser votre mot de passe sur SnowTricks.')
            ->htmlTemplate('emails/resetPassword.html.twig')
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
