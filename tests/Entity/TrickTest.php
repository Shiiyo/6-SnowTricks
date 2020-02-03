<?php

namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class TrickTest extends TestCase
{
    private $trick;

    public function setUp()
    {
        $this->trick = new Trick();
    }

    public function testUser()
    {
        $user = new User();
        $this->trick->setUser($user);
        $this->assertSame($user, $this->trick->getUser());
    }

    public function testName()
    {
        $this->trick->setName('Test');
        $this->assertSame('Test', $this->trick->getName());
    }

    public function testContent()
    {
        $this->trick->setContent('Test');
        $this->assertSame('Test', $this->trick->getContent());
    }

    public function testCreatedAt()
    {
        $dateCreated = new \DateTime('2020-01-28T15:03:01.012345Z');
        $this->trick->setCreatedAt($dateCreated);
        $this->assertSame($dateCreated, $this->trick->getCreatedAt());
    }

    public function testGetComments()
    {
        $comment = new Comment();
        $this->trick->addComment($comment);
        $commentArray[] = $comment;
        $commentCollection = new ArrayCollection($commentArray);
        $this->assertEquals($commentCollection, $this->trick->getComments());
    }
}
