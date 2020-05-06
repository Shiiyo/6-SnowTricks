<?php

namespace App\Tests\Entity;

use App\Entity\Trick;
use App\Entity\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    private $video;

    public function setUp()
    {
        $this->video = new Video();
    }

    public function testTrick()
    {
        $trick = new Trick();
        $this->video->setTrick($trick);
        $this->assertSame($trick, $this->video->getTrick());
    }

    public function testName()
    {
        $this->video->setName('Test');
        $this->assertSame('Test', $this->video->getName());
    }

    public function hostName()
    {
        $host = 'test';
        $this->video->setHostName($host);
        $this->assertEquals($host, $this->video->getHostName());
    }
}
