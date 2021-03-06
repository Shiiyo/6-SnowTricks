<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Picture\MinifiedPicture;
use App\Repository\CommentRepository;
use App\VideoHostTemplate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * @Route("/trick/{slug}", name="trick")
     */
    public function index(Trick $trick, Request $request, EntityManagerInterface $manager, CommentRepository $commentRepo)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime());
            $comment->setUser($this->getUser());
            $comment->setTrick($trick);

            $manager->persist($comment);
            $manager->flush();

            $this->addFlash('success', 'Merci pour votre commentaire !');

            return $this->redirectToRoute('trick', ['slug' => $trick->getSlug()]);
        }

        //Get the url of each video in this trick
        $hostTemplate = new VideoHostTemplate();
        foreach ($trick->getVideos() as $video) {
            $url = $hostTemplate->getHostTemplate($video->getHostName(), $video->getName());
            $video->setUrl($url);
        }

        //Minified profile picture in comments
        $comments = $commentRepo->findPageOfComment(0, 10, $trick->getId());

        foreach ($comments as $comment) {
            $profilPicture = $comment->getUser()->getPicture();
            $miniPicture = new MinifiedPicture();
            if (null !== $profilPicture) {
                $miniFilePicture = $miniPicture->getMiniFileName($profilPicture);
                $profilPicture->setMiniFile($miniFilePicture);
            }
        }

        return $this->render('trick.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/trick/supprimer/{id}", name="trick_delete")
     */
    public function delete(Trick $trick, EntityManagerInterface $manager, $upload_directory)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $frontPicture = $trick->getFrontPicture();
        $pictures = $trick->getPictures();

        //Remove the trick
        $manager->remove($trick);
        $manager->flush();

        //Remove the front picture in DB and in the server
        if (null !== $frontPicture) {
            $manager->remove($frontPicture);
            $mini = new MinifiedPicture();
            $miniPicture = $mini->getMiniFileName($frontPicture);
            unlink($upload_directory.'/'.$frontPicture->getFile());
            unlink($upload_directory.'/'.$miniPicture);
        }

        //Remove each pictures in DB and in the server
        if (null !== $pictures) {
            foreach ($pictures as $picture) {
                $manager->remove($picture);
                unlink($upload_directory.'/'.$picture->getFile());
            }
        }

        $manager->flush();

        $this->addFlash('success', 'Le trick est bien supprimé !');

        return $this->redirectToRoute('home');
    }
}
