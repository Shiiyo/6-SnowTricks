<?php

namespace App\Security;

use App\Entity\Token;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class GenerateToken
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->setManager($manager);
    }

    public function generateToken(User $user)
    {
        $token = new Token();
        $user->setToken($token);
        $token->setValue(bin2hex(random_bytes(32)))
            ->setExpiryDate(new \DateTime('+25 hours'));

        $this->manager->persist($token);
        $this->manager->persist($user);
        $this->manager->flush();

        return $token;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param EntityManagerInterface $manager
     */
    public function setManager($manager): void
    {
        $this->manager = $manager;
    }
}
