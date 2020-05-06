<?php

namespace App\Controller\Security;

use App\Form\ForgotPasswordType;
use App\Mailer\ResetPasswordMailer;
use App\Repository\UserRepository;
use App\Security\GenerateToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ForgotPasswordController extends AbstractController
{
    /**
     * @Route ("/mot-de-passe-oublie", name="forgot_password")
     */
    public function index(UserRepository $userRepo, Request $request, GenerateToken $generateToken, ResetPasswordMailer $mailer, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ForgotPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userDTO = $form->getData();
            $user = $userRepo->findOneBy(['username' => $userDTO->username]);

            if (null !== $user) {
                if (null !== $user->getToken()) {
                    $manager->remove($user->getToken());
                    $manager->flush();
                }
                $token = $generateToken->generateToken($user);
                $mailer->sendEmail($user, $token);

                $this->addFlash('success', 'Un email vous a été envoyé.');
            } else {
                $this->addFlash('error', 'Votre pseudo n\'existe pas');
            }
        }

        return $this->render('security/forgotPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
