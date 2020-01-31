<?php

namespace App\Tests\Entity;

use App\Entity\Trick;
use App\Entity\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    private $video;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->video = new Video();
    }

    public function testTricks()
    {
        $this->video->setTrick(new Trick());
        $this->assertEquals(new Trick(), $this->video->getTrick());
    }

    public function testName()
    {
        $this->video->setName('Test');
        $this->assertEquals('Test', $this->video->getName());
    }
}
