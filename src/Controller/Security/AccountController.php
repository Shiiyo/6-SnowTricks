<?php

namespace App\Controller\Security;

use App\Entity\Picture;
use App\Entity\User;
use App\Form\AccountType;
use App\Picture\MinifiedPicture;
use App\Picture\SquareProfilePicture;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/modification-compte/{id}", name="user_edit")
     */
    public function index(User $user, $upload_directory, $temp_directory, UserRepository $userRepo, Request $request, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $this->denyAccessUnlessGranted('edit', $user);

        $form = $this->createForm(AccountType::class);


        //Get minified profil picture
        $picture = $user->getPicture();
        $mini = new MinifiedPicture();
        if($picture !== null)
        {
            $miniPicture = $mini->getMiniFileName($picture);
            $picture->setMiniFile($miniPicture);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accountDTO = $form->getData();

            //Save the profile picture
            $file = $form->get('picture')->getData();

            if (null !== $file) {
                //Temporary save the original picture
                $name = $file->getClientOriginalName();
                $mimeType = $file->guessExtension();
                $file->move($temp_directory, $name);

                //Square profile picture
                $square = new SquareProfilePicture();
                $newFile = $square->squarePicture($mimeType, $temp_directory.'/'.$name, $upload_directory);
                unlink($temp_directory.'/'.$name);

                //Delete existing profile picture
                if($picture !== null)
                {
                    unlink($upload_directory.'/'.$picture->getFile());
                    unlink($upload_directory.'/'.$miniPicture);
                    $manager->remove($user->getPicture());
                    $manager->flush();
                }

                //Create minified picture
                $mini->minified($newFile, $mimeType, $upload_directory);

                //Save Profile Picture
                $profilePicture = new Picture();
                $profilePicture->setFile($newFile.'.'.$mimeType);
                $profilePicture->setUser($user);

                $user->setPicture($profilePicture);
                $manager->persist($profilePicture);
            }

            if ($accountDTO->username !== $user->getUsername())
            {
                $user->setUsername($accountDTO->username);
            }

            if ($accountDTO->email !== $user->getEmail())
            {
                $user->setEmail($accountDTO->email);
            }

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Votre compte a bien été modifié.');

            return $this->redirectToRoute('home');
        }
        return $this->render('security/account.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}