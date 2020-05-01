<?php

namespace App\Controller\AJAX;

use App\Picture\MinifiedPicture;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjaxLoadMoreComment extends AbstractController
{
    /**
     * @Route("load-more-comments", name="load_more_comments")
     */
    public function loadMore(CommentRepository $repo, Request $request)
    {
        $numberOfComment = $request->request->get('numberOfComments');
        $trickId = $request->request->get('trickId');

        $minCommentNumber = $numberOfComment + 1;
        $maxCommentNumber = 10;

        $comments = $repo->findPageOfComment($minCommentNumber, $maxCommentNumber, $trickId);

        //Get mini files of pictures
        foreach ($comments as $comment) {
            $profilPicture = $comment->getUser()->getPicture();
            $miniPicture = new MinifiedPicture();
            if (null !== $profilPicture) {
                $miniFilePicture = $miniPicture->getMiniFileName($profilPicture);
                $profilPicture->setMiniFile($miniFilePicture);
            }
        }

        return $this->render('ajaxLoadMore/loadMoreComments.html.twig', [
            'comments' => $comments,
        ]);
    }
}
