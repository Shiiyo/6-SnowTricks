<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Mailer\RegistrationMailer;
use App\Security\GenerateToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="registration")
     * @Route("/modification-compte/{id}", name="user_edit")
     */
    public function index(User $user = null, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, RegistrationMailer $mailer, GenerateToken $generateToken)
    {
        if (!$user) {
            $user = new User();
        } else {
            $this->denyAccessUnlessGranted('ROLE_USER');
            $this->denyAccessUnlessGranted('edit', $user);
        }

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            if (null == $user->getId()) {
                $user->setIsActive(0);
            }

            $manager->persist($user);
            $manager->flush();

            $token = $generateToken->generateToken($user);
            $mailer->sendEmail($user, $token);

            return $this->redirectToRoute('home');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            'editMode' => null !== $user->getId(),
            'user_id' => $user->getId(),
        ]);
    }
}
