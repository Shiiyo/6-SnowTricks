<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        //Create 20 Users
        for ($i = 1; $i <= 20; ++$i) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setUsername($faker->lastName);
            $user->setPassword($faker->password);
            $user->setIsActive(1);

            $manager->persist($user);
        }
    }
}
