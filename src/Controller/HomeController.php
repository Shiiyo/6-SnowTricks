<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use App\VideoHostTemplate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TrickRepository $repo)
    {
        $tricks = $repo->findBy([], ['createdAt' => 'desc']);

        $url = 'https://www.dailymotion.com/embed/video/x7slzc8';
        $hostTemplate = new VideoHostTemplate();
        $hostName = $hostTemplate->getHostName($url);
        var_dump($hostName);

        $idvVideo = $hostTemplate->getVideoName($url, $hostName);
        var_dump($idvVideo);

        return $this->render('home.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
