<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Create Users
        $userFixture = new UserFixtures();
        $userFixture->load($manager);

        //Create TrickGroups
        $trickGroupFixture = new TrickGroupFixtures();
        $trickGroupFixture->load($manager);

        $manager->flush();

        //Create tricks
        $trickFixture = new TrickFixtures();
        $trickFixture->load($manager);
        $manager->flush();

        //Create comment for each trick
        $commentFixtures = new CommentFixtures();
        $commentFixtures->load($manager);

        //Create pictures
        $pictureFixtures = new PictureFixtures();
        $pictureFixtures->load($manager);

        //Create videos
        $videoFixtures = new VideoFixtures();
        $videoFixtures->load($manager);

        $manager->flush();
    }
}
