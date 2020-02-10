<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="registration")
     * @Route("/modification/{id}", name="user_edit")
     */
    public function index(User $user = null, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        if (!$user) {
            $user = new User();
        }

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('registration.html.twig', [
            'form' => $form->createView(),
            'editMode' => null !== $user->getId(),
            'user_id' => $user->getId(),
        ]);
    }
}
