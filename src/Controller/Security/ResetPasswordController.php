<?php

namespace App\Controller\Security;

use App\Form\ResetPasswordType;
use App\Repository\TokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route ("/reset-password/{tokenValue}", name="reset_password")
     */
    public function index($tokenValue, Request $request, TokenRepository $tokenRepo, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $token = $tokenRepo->findOneBy(['value' => $tokenValue]);

        if (null !== $token) {
            $user = $token->getUser();

            if ($token->getExpiryDate() > new \DateTime('now') && null !== $user) {
                $form = $this->createForm(ResetPasswordType::class, $user);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $hash = $encoder->encodePassword($user, $user->getPassword());
                    $user->setPassword($hash);

                    $manager->persist($user);
                    $manager->remove($token);
                    $manager->flush();

                    $this->addFlash('success', 'Votre mot de passe a bien été modifié, vous pouvez vous connecter.');

                    return $this->redirectToRoute('home');
                }

                return $this->render('security/resetPassword.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
            $manager->remove($token);
            $manager->flush();
            $this->addFlash('error', 'Votre lien a expiré merci de renouveler votre demande.');
            return $this->redirectToRoute('home');
        }
        $this->addFlash('error', 'Votre lien n\'est pas bon, merci de réessayer.');

        return $this->redirectToRoute('home');
    }
}
