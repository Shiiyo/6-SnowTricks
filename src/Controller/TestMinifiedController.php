<?php

namespace App\Controller;

use App\MinifiedPicture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestMinifiedController extends AbstractController
{
    /**
     * @Route ("/mini", name="mini")
     */
    public function index()
    {
        $picture = 'img/index.jpg';
        $minified = new MinifiedPicture();
        $mini = $minified->minified($picture);

        return $this->render('mini.html.twig', ['mini' => $mini]);
    }
}