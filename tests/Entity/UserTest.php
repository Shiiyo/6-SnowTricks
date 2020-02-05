<?php

namespace App\Tests;

use App\Entity\Picture;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function testEmail()
    {
        $this->user->setEmail('test@test.fr');
        $this->assertSame('test@test.fr', $this->user->getEmail());
    }

    public function testUsername()
    {
        $this->user->setUsername('Test');
        $this->assertSame('Test', $this->user->getUsername());
    }

    public function testPassword()
    {
        $this->user->setPassword('Test');
        $this->assertSame('Test', $this->user->getPassword());
    }

    public function testPicture()
    {
        $picture = new Picture();
        $this->user->setPicture($picture);
        $this->assertSame($picture, $this->user->getPicture());
    }
}
