<?php

namespace App\Controller\Security;

use App\Entity\Picture;
use App\Entity\User;
use App\Form\AccountType;
use App\Picture\MinifiedPicture;
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
    public function index(User $user, $upload_directory, UserRepository $userRepo, Request $request, EntityManagerInterface $manager)
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
                $fileName = md5(uniqid());
                $typeMime = $file->guessExtension();
                $completeFileName =  $fileName.'.'. $typeMime;
                $file->move($upload_directory, $completeFileName);

                //Minified picture
                $mini = new MinifiedPicture();
                $mini->minified($fileName, $typeMime, $upload_directory);

                $profilePicture = new Picture();
                $profilePicture->setFile($completeFileName);
                $profilePicture->setUser($user);

                //Delete existing profile picture
                if($user->getPicture() !== null)
                {
                    $manager->remove($user->getPicture());
                    $manager->flush();
                }

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