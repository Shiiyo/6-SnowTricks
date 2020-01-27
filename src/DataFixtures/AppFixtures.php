<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

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

        $manager->flush();
    }
}
