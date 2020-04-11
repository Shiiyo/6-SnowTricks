<?php

namespace App\Controller;

use App\Form\TestType;
use App\Picture\SavePicture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestMinifiedController extends AbstractController
{
    /**
     * @Route ("/mini", name="mini")
     */
    public function index(Request $request)
    {

        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData()->getFile();
            $save = new SavePicture();
            $return = $save->savePicture($picture);

            return $this->render('mini.html.twig', ['test' => $return]);
        }

        return $this->render('mini.html.twig', ['form' => $form->createView()]);
    }
}