<?php

namespace App\Tests\Entity;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class PictureTest extends TestCase
{
    private $picture;

    public function setUp()
    {
        $this->picture = new Picture();
    }

    public function testTrick()
    {
        $trick = new Trick();
        $this->picture->setTrick($trick);
        $this->assertEquals($trick, $this->picture->getTrick());
    }

    public function testUser()
    {
        $user = new User();
        $this->picture->setUser($user);
        $this->assertSame($user, $this->picture->getUser());
    }

    public function testFile()
    {
        $this->picture->setFile('Test');
        $this->assertSame('Test', $this->picture->getFile());
    }
}
