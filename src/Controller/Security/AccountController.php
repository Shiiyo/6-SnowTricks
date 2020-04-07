<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\AccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/modification-compte/{id}", name="user_edit")
     */
    public function index(User $user, Request $request, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $this->denyAccessUnlessGranted('edit', $user);

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Save the profile picture
            $profilePicture = $form->get('picture')->getData()->getFile();
            if (null !== $profilePicture) {
                $file = $profilePicture->getData();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $profilePicture->setFile($fileName);
                $profilePicture->setUser($user);
                $manager->persist($profilePicture);
            } else {
                $user->setPicture(null);
            }

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Votre compte a bien été modifié.');

            return $this->redirectToRoute('home');
        }
        return $this->render('security/account.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}