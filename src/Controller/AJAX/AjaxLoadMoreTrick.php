<?php

namespace App\Controller\AJAX;


use App\Picture\MinifiedPicture;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjaxLoadMoreTrick extends AbstractController
{
    /**
     * @Route("load-more-tricks", name="load_more_tricks")
     */
    public function loadMore(TrickRepository $repo, Request $request)
    {
        $numberOfTrick = $request->request->get('numberOfTricks');

        $minTrickNumber = $numberOfTrick + 1;
        $maxTrickNumber = 8;
        $tricks = $repo->findPageOfTricks($minTrickNumber, $maxTrickNumber);

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

        return $this->render('ajaxLoadMore/loadMoreTricks.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}