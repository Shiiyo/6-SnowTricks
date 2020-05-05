<?php

namespace App\Security\Interfaces;

use App\Entity\Token;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

interface GenerateTokenInterface
{
    /**
     * GenerateTokenInterface constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager);

    /**
     * @param User $user
     * @return Token
     */
    public function generateToken(User $user);
}