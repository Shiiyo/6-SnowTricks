<?php

namespace App\Security\Interfaces;

use App\Entity\Token;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

interface GenerateTokenInterface
{
    /**
     * GenerateTokenInterface constructor.
     */
    public function __construct(EntityManagerInterface $manager);

    /**
     * @return Token
     */
    public function generateToken(User $user);
}
