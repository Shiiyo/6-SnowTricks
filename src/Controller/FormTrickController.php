<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use App\Form\TrickType;
use App\Picture\MinifiedPicture;
use App\VideoHostTemplate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class FormTrickController extends AbstractController
{
    /**
     * @Route("/nouveau-trick", name="new_trick")
     * @Route("/modification/{slug}", name="trick_edit")
     */
    public function index(Trick $trick = null, Request $request, EntityManagerInterface $manager, $upload_directory)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

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
            $file = $form->get('frontPicture')->getData();

            if (null !== $file) {
                $frontPicture = new Picture();
                $fileName = md5(uniqid());
                $typeMime = $file->guessExtension();
                $completeFileName =  $fileName.'.'. $typeMime;
                $file->move($upload_directory, $completeFileName);

                //Minified picture
                $mini = new MinifiedPicture();
                $mini->minified($fileName, $typeMime, $upload_directory);

                $frontPicture->setFile($completeFileName);
                $trick->setFrontPicture($frontPicture);

                $manager->persist($frontPicture);
            }

            //Save all the pictures
            foreach ($form->get('pictures') as $pictureForm) {
                /** @var Picture $picture */
                $picture = $pictureForm->getData();
                $file = $pictureForm->get('file')->getData();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $picture->setFile($fileName);
                $file->move($upload_directory, $fileName);
                $picture->setTrick($trick);
                $manager->persist($picture);
            }

            //Save video
            $videosURL = $form->get('videos')->getData();
            foreach ($videosURL as $videoURL) {
                $video = new Video();
                $hostTemplate = new VideoHostTemplate();

                $hostName = $hostTemplate->getHostName($videoURL);
                $video->setHostName($hostName);

                $videoName = $hostTemplate->getVideoName($videoURL, $hostName);
                $video->setName($videoName);

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
