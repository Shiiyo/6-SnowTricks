<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormTrickController extends AbstractController
{
    /**
     * @Route("/nouveau-trick", name="new_trick")
     * @Route("/modification/{id}", name="trick_edit")
     */
    public function index(Trick $trick = null, Request $request, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$trick) {
            $trick = new Trick();
            $trick->setCreatedAt(new \DateTime());
        }
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictures = $trick->getPictures();
            foreach ($pictures as  $picture) {
                $file = $picture->getFile();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $picture->setFile($fileName);
                $picture->setTrick($trick);
                $manager->persist($picture);
            }

            $trick->setUser($this->getUser());
            $manager->persist($trick);
            $manager->flush();

            $this->addFlash('success', 'Le trick est bien enregistré !');

            return $this->redirectToRoute('home');
        }

        return $this->render('formTrick.html.twig', [
            'form' => $form->createView(),
            'editMode' => null !== $trick->getId(),
        ]);
    }
}
