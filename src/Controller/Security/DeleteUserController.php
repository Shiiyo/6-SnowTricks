<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Picture\MinifiedPicture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserController extends AbstractController
{
    /**
     * @Route("/admin/supprimer/{id}", name="delete_user")
     */
    public function index(User $user, EntityManagerInterface $manager, $upload_directory)
    {
        $this->denyAccessUnlessGranted('edit', $user);

        if (null !== $user->getPicture()) {
            //Delete the profil picture and the minified version in the server
            $mini = new MinifiedPicture();
            $miniPicture = $mini->getMiniFileName($user->getPicture());
            unlink($upload_directory.'/'.$miniPicture);
            unlink($upload_directory.'/'.$user->getPicture()->getFile());
        }

        $manager->remove($user);
        $manager->flush();

        $session = new Session();
        $session->invalidate();

        $session->getFlashBag()->add('success', 'Votre compte a bien été supprimé!');

        return $this->redirectToRoute('home');
    }
}
