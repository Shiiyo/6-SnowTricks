<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use App\Form\TrickType;
use App\VideoHostTemplate;
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
            $frontPicture = $form->get('frontPicture')->getData();
            $pictures = $form->get('pictures')->getData();

            //Save the front picture name file
            if (null !== $frontPicture->getFile()) {
                $file = $frontPicture->getFile();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $frontPicture->setFile($fileName);
                $frontPicture->setTrick($trick);
                $manager->persist($frontPicture);
            } else {
                $trick->setFrontPicture(null);
            }

            //Save all the pictures
            foreach ($pictures as  $picture) {
                if (null !== $picture->getFile()) {
                    $file = $picture->getFile();
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($this->getParameter('upload_directory'), $fileName);
                    $picture->setFile($fileName);
                    $picture->setTrick($trick);
                    $manager->persist($picture);
                } else {
                    $trick->removePicture($picture);
                }
            }

            //Save video
            /*            $videoUrl = $form->get('videos')->getData();
                        $video = new Video();
                        $hostTemplate = new VideoHostTemplate();

                        $hostName = $hostTemplate->getHostName($videoUrl);
                        $video->setHostName($hostName);

                        $videoName = $hostTemplate->getVideoName($videoUrl, $hostName);
                        $video->setName($videoName);

                        $video->setTrick($trick);
                        $manager->persist($video);*/

            $trick->setUser($this->getUser());
            $manager->persist($trick);
            $manager->flush();

            $this->addFlash('success', 'Le trick est bien enregistré !');

            return $this->redirectToRoute('home');
        }

        return $this->render('formTrick.html.twig', [
            'form' => $form->createView(),
            'editMode' => null !== $trick->getId(),
            'trick' => $trick,
        ]);
    }

    /**
     * @Route("/supprimer-image/{id}", name="delete_picture")
     */
    public function deletePicture(Picture $picture, EntityManagerInterface $manager)
    {
        $manager->remove($picture);
        $manager->flush();

        return $this->json(['code' => 200, 'message' => 'Photo supprimé.'], 200);
    }
}
