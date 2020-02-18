<?php

namespace App\Tests\Entity;

use App\Entity\Token;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    private $token;

    public function setUp()
    {
        $this->token = new Token();
    }

    public function testValue()
    {
        $this->token->setValue('toto');
        $this->assertSame('toto', $this->token->getValue());
    }

    public function testExpiryDate()
    {
        $date = new \DateTime('now');
        $this->token->setExpiryDate($date);
        $this->assertSame($date, $this->token->getExpiryDate());
    }

    public function testUser()
    {
        $user = new User();
        $this->token->setUser($user);
        $this->assertSame($user, $this->token->getUser());
    }
}
