<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        //Create 20 Users
        for($i = 1; $i <= 20; $i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setName($faker->lastName);
            $user->setFirstName($faker->firstName);
            $user->setPassword($faker->password);

            $manager->persist($user);
        }
    }
}