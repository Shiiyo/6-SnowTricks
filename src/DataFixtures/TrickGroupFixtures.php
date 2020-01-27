<?php

namespace App\DataFixtures;

use App\Entity\TrickGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrickGroupFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        //Create 8 trick_group
        for ($j = 1; $j <= 8; $j++) {
            $trickGroup = new TrickGroup();
            $trickGroup->setName($faker->word());

            $manager->persist($trickGroup);
        }
    }
}
