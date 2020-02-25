<?php

namespace App\Controller;

use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * @Route("/trick/{id}", name="trick")
     */
    public function index(Trick $trick)
    {
        return $this->render('trick.html.twig', [
            'trick' => $trick,
        ]);
    }

    /**
     * @Route("/trick/supprimer/{id}", name="trick_delete")
     */
    public function delete(Trick $trick, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $manager->remove($trick);
        $manager->flush();

        $this->addFlash('success', 'Le trick est bien supprimé !');

        return $this->redirectToRoute('home');
    }
}
