<?php

namespace App\Controller\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserController extends AbstractController
{
    /**
     * @Route("/delete/{id}", name="delete_user")
     */
    public function index(User $user, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $this->denyAccessUnlessGranted('edit', $user);

        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('home');
    }
}
