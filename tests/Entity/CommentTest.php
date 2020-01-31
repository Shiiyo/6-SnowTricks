<?php

namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    private $comment;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->comment = new Comment();
    }

    public function testUser()
    {
        $this->comment->setUser(new User());
        $this->assertEquals(new User(), $this->comment->getUser());
    }

    public function testCreatedAt()
    {
        $this->comment->setCreatedAt(new \DateTime('2020-01-28T15:03:01.012345Z'));
        $this->assertEquals(new \DateTime('2020-01-28T15:03:01.012345Z'), $this->comment->getCreatedAt());
    }

    public function testContent()
    {
        $this->comment->setContent('Test');
        $this->assertEquals('Test', $this->comment->getContent());
    }

    public function testTrick()
    {
        $this->comment->setTrick(new Trick());
        $this->assertEquals(new Trick(), $this->comment->getTrick());
    }
}
