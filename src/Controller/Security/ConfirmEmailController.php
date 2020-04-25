<?php

namespace App\Controller\Security;

use App\Repository\TokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmEmailController extends AbstractController
{
    /**
     * @Route ("/registration/{tokenValue}", name="confirm_email")
     */
    public function index($tokenValue, TokenRepository $tokenRepo, EntityManagerInterface $manager)
    {
        $token = $tokenRepo->findOneBy(['value' => $tokenValue]);
        if (null !== $token) {
            if ($token->getExpiryDate() > new \DateTime('now')) {
                $token->getUser()->setIsActive(1);
                $manager->remove($token);
                $manager->flush();

                $this->addFlash('success', 'Votre email a bien été confirmé, vous pouvez désormais vous connecter.');

                return $this->redirectToRoute('home');
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
