<?php

namespace App\Controller;

use App\Picture\MinifiedPicture;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TrickRepository $repo)
    {
        $tricks = $repo->findPageOfTricks(0, 8);
        $nbTricks = $repo->countTricks();

        //Get mini files of pictures
        foreach ($tricks as $trick)
        {
            $picture = $trick->getFrontPicture();
            $miniPicture = new MinifiedPicture();
            if($picture !== null)
            {
                $miniFilePicture = $miniPicture->getMiniFileName($picture);
                $picture->setMiniFile($miniFilePicture);
            }
        }

        return $this->render('home.html.twig', [
            'tricks' => $tricks,
            'nbTricks' => $nbTricks
        ]);
    }
}
