<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Picture\SavePicture;
use App\SaveVideo;
use App\VideoHostTemplate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class FormTrickController extends AbstractController
{
    /**
     * @Route("/admin/nouveau-trick", name="new_trick")
     * @Route("/admin/modification-trick/{slug}", name="trick_edit")
     */
    public function index(Trick $trick = null, Request $request, EntityManagerInterface $manager, $upload_directory)
    {
        //Creation mode: create a new trick
        if (!$trick) {
            $trick = new Trick();
            $trick->setCreatedAt(new \DateTime());
        }

        //Get the url of each video in this trick
        $hostTemplate = new VideoHostTemplate();
        foreach ($trick->getVideos() as $video) {
            $url = $hostTemplate->getHostTemplate($video->getHostName(), $video->getName());
            $video->setUrl($url);
        }

        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Create a slug with the name of the trick
            $slugCreator = new AsciiSlugger();
            $slug = $slugCreator->slug($trick->getName());
            $trick->setSlug($slug);

            //Save the front picture name file
            $savePicture = new SavePicture();
            $file = $form->get('frontPicture');

            if (null !== $file->get('file')->getData()) {
                $frontPicture = $savePicture->saveFrontPicture($file, $upload_directory);
                $trick->setFrontPicture($frontPicture);
                $manager->persist($frontPicture);
            }

            //Save all the pictures
            foreach ($form->get('pictures') as $pictureForm) {
                $picture = $savePicture->savePicture($pictureForm, $upload_directory);
                $picture->setTrick($trick);
                $manager->persist($picture);
            }

            //Save video
            $videosURL = $form->get('videos')->getData();
            $saveVideo = new SaveVideo();
            foreach ($videosURL as $videoURL) {
                $video = $saveVideo->saveVideo($videoURL);
                $video->setTrick($trick);
                $manager->persist($video);
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
            'trick' => $trick,
        ]);
    }
}
