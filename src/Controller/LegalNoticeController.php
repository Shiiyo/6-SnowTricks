<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{
    /**
     * @Route ("/mentions-legales", name="legal_notice")
     */
    public function index()
    {
        return $this->render('legalNotice.html.twig');
    }

}