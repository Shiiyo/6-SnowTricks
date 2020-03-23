<?php

namespace App\Controller\AJAXDelete;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AjaxDeleteVideoController extends AbstractController
{
    /**
     * @Route("supprimer-video/{id}", name="delete_video")
     */
    public function deleteVideo(Video $video, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $manager->remove($video);
        $manager->flush();

        return $this->json(['code' => 200, 'message' => 'Vidéo supprimé'], 200);
    }
}
