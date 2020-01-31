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

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->trick = new Trick();
    }

    public function testUser()
    {
        $this->trick->setUser(new User());
        $this->assertEquals(new User(), $this->trick->getUser());
    }

    public function testName()
    {
        $this->trick->setName('Test');
        $this->assertEquals('Test', $this->trick->getName());
    }

    public function testContent()
    {
        $this->trick->setContent('Test');
        $this->assertEquals('Test', $this->trick->getContent());
    }

    public function testCreatedAt()
    {
        $this->trick->setCreatedAt(new \DateTime('2020-01-28T15:03:01.012345Z'));
        $this->assertEquals(new \DateTime('2020-01-28T15:03:01.012345Z'), $this->trick->getCreatedAt());
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
