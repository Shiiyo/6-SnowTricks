<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\ForgotPasswordType;
use App\Mailer\ResetPasswordMailer;
use App\Repository\UserRepository;
use App\Security\GenerateToken;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ForgotPasswordController extends AbstractController
{
    /**
     * @Route ("/forgot-password", name="forgot_password")
     */
    public function index(UserRepository $userRepo, Request $request, GenerateToken $generateToken, ResetPasswordMailer $mailer)
    {
        $user = new User();
        $form = $this->createForm(ForgotPasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->getData();
            $user = $userRepo->findOneBy(['username' => $username]);

            if (null !== $user) {
                $token = $generateToken->generateToken($user);
                $mailer->sendEmail($user, $token);

                $this->addFlash('success', 'Un email vous a été envoyé.');

                return $this->render('forgotPassword.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            $this->addFlash('error', 'Votre pseudo n\'existe pas');

            return $this->render('forgotPassword.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        return $this->render('forgotPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
