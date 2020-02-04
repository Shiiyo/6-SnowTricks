<?php

namespace App\Controller;

use App\Entity\Trick;
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
}
