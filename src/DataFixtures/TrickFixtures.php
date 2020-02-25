<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $userArray = $manager->getRepository('App\Entity\User')->findAll();
        $trickGroupArray = $manager->getRepository('App\Entity\TrickGroup')->findAll();

        //Create tricks and comment in each trick
        for ($k = 1; $k <= 10; ++$k) {
            $trick = new Trick();
            $trick->setName($faker->words(2, true));
            $trick->setContent($faker->paragraphs(5, true));
            shuffle($userArray);
            $trick->setUser($userArray[0]);
            $trick->setCreatedAt($faker->dateTimeBetween('-3 month', 'now'));
            shuffle($trickGroupArray);
            $trickGroup = $trickGroupArray[0];
            $trick->setTrickGroup($trickGroup);
            $trickGroup->addTrick($trick);

            $manager->persist($trick);
            $manager->persist($trickGroup);
        }
    }
}
