<?php

namespace App\Tests;

use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\Token;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
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

    public function testToken()
    {
        $token = new Token();
        $this->user->setToken($token);
        $this->assertSame($token, $this->user->getToken());
    }

    public function testIsActive()
    {
        $this->user->setIsActive(1);
        $this->assertSame(true, $this->user->getIsActive());
    }

    public function testComments()
    {
        $comment = new Comment();
        $this->user->addComment($comment);
        $commentArray[] = $comment;
        $commentCollection = new ArrayCollection($commentArray);
        $this->assertEquals($commentCollection, $this->user->getComments());
    }
}
