<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\AccountType;
use App\Picture\MinifiedPicture;
use App\Picture\SavePicture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/admin/modification-compte/{id}", name="user_edit")
     */
    public function index(User $user, $upload_directory, $temp_directory, Request $request, EntityManagerInterface $manager)
    {
        $this->denyAccessUnlessGranted('edit', $user);

        $form = $this->createForm(AccountType::class);

        //Get minified profil picture
        $picture = $user->getPicture();
        if (null !== $picture) {
            $mini = new MinifiedPicture();
            $miniPicture = $mini->getMiniFileName($picture);
            $picture->setMiniFile($miniPicture);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accountDTO = $form->getData();

            //Save the profile picture
            $file = $accountDTO->picture->picture;

            if (null !== $file) {

                $savePicture = new SavePicture();
                $profilePicture = $savePicture->saveAccountPicture($file, $temp_directory, $upload_directory, $user);

                //Delete existing profile picture
                if (null !== $picture) {
                    unlink($upload_directory.'/'.$picture->getFile());
                    unlink($upload_directory.'/'.$miniPicture);
                    $manager->remove($user->getPicture());
                    $manager->flush();
                }

                $user->setPicture($profilePicture);
                $manager->persist($profilePicture);
            }

            if ($accountDTO->username !== $user->getUsername()) {
                $user->setUsername($accountDTO->username);
            }

            if ($accountDTO->email !== $user->getEmail()) {
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
