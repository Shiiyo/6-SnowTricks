<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\AccountType;
use App\Mailer\RegistrationMailer;
use App\Security\GenerateToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * @Route("/modification-compte/{id}", name="user_edit")
     */
    public function index(User $user, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, RegistrationMailer $mailer, GenerateToken $generateToken)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $this->denyAccessUnlessGranted('edit', $user);

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $token = $generateToken->generateToken($user);
            $mailer->sendEmail($user, $token);

            $this->addFlash('success', 'Votre compte est créé, vous allez recevoir un email de confirmation.');

            return $this->redirectToRoute('home');
        }
        return $this->render('security/account.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);

    }
}