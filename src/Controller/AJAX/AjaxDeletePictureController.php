<?php

namespace App\Controller\AJAX;

use App\Entity\Picture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AjaxDeletePictureController extends AbstractController
{
    /**
     * @Route("/supprimer-image/{id}", name="delete_picture")
     */
    public function deletePicture(Picture $picture, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $manager->remove($picture);
        $manager->flush();

        return $this->json(['code' => 200, 'message' => 'Photo supprimé.'], 200);
    }
}
