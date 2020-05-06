<?php

namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    private $comment;

    public function setUp()
    {
        $this->comment = new Comment();
    }

    public function testCreatedAt()
    {
        $dateCreate = new \DateTime('2020-01-28T15:03:01.012345Z');
        $this->comment->setCreatedAt($dateCreate);
        $this->assertSame($dateCreate, $this->comment->getCreatedAt());
    }

    public function testContent()
    {
        $this->comment->setContent('Test');
        $this->assertSame('Test', $this->comment->getContent());
    }

    public function testTrick()
    {
        $trick = new Trick();
        $this->comment->setTrick($trick);
        $this->assertSame($trick, $this->comment->getTrick());
    }

    public function testUser()
    {
        $user = new User();
        $this->comment->setUser($user);
        $this->assertSame($user, $this->comment->getUser());
    }
}
