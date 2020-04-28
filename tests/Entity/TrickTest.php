<?php

namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Entity\User;
use App\Entity\Video;
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

    public function testUpdatedAt()
    {
        $dateUpdated = new \DateTime('2020-02-28T15:03:01.012345Z');
        $this->trick->setUpdatedAt($dateUpdated);
        $this->assertSame($dateUpdated, $this->trick->getUpdatedAt());
    }

    public function testGetComments()
    {
        $comment = new Comment();
        $this->trick->addComment($comment);
        $commentArray[] = $comment;
        $commentCollection = new ArrayCollection($commentArray);
        $this->assertEquals($commentCollection, $this->trick->getComments());
    }

    public function testPictures()
    {
        $picture = new Picture();
        $this->trick->addPicture($picture);
        $pictureArray[] = $picture;
        $pictureCollection = new ArrayCollection($pictureArray);
        $this->assertEquals($pictureCollection, $this->trick->getPictures());
    }

    public function testVideos()
    {
        $video = new Video();
        $this->trick->addVideo($video);
        $videoArray[] = $video;
        $videoCollection = new ArrayCollection($videoArray);
        $this->assertEquals($videoCollection, $this->trick->getVideos());
    }

    public function testTrickGroup()
    {
        $trickGroup = new TrickGroup();
        $this->trick->setTrickGroup($trickGroup);
        $this->assertEquals($trickGroup, $this->trick->getTrickGroup());
    }

    public function testFrontPicture()
    {
        $picture = new Picture();
        $this->trick->setFrontPicture($picture);
        $this->assertEquals($picture, $this->trick->getFrontPicture());
    }

    public function testSlug()
    {
        $slug = 'test';
        $this->trick->setSlug($slug);
        $this->assertEquals($slug, $this->trick->getSlug());
    }
}
