<?php

namespace App\Tests\Entity;

use App\Entity\Trick;
use App\Entity\TrickGroup;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class TrickGroupTest extends TestCase
{
    private $trickGroup;

    public function setUp()
    {
        $this->trickGroup = new TrickGroup();
    }

    public function testName()
    {
        $this->trickGroup->setName('Test');
        $this->assertSame('Test', $this->trickGroup->getName());
    }

    public function testTricks()
    {
        $trick = new Trick();
        $this->trickGroup->addTrick($trick);
        $trickArray[] = $trick;
        $trickCollection = new ArrayCollection($trickArray);
        $this->assertEquals($trickCollection, $this->trickGroup->getTricks());
    }
}
