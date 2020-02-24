<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogInController extends AbstractController
{
    /**
     * @Route("/login", name="log_in")
     */
    public function index()
    {
        return $this->render('login.html.twig');
    }
}