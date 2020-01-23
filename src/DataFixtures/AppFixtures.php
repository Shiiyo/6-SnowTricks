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

        //Create 20 User
        $userArray = Array();
        for($i = 1; $i <= 20; $i++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setName($faker->lastName);
            $user->setFirstName($faker->firstName);
            $user->setPassword($faker->password);
            $userArray[] = $user;

            $manager->persist($user);
        }
        //Create 8 trick_group
        $trickGroupArray = Array();
        for ($j = 1; $j <= 8; $j++) {
            $trickGroup = new TrickGroup();
            $trickGroup->setName($faker->word());
            $trickGroupArray[] = $trickGroup;

            $manager->persist($trickGroup);
        }

        for ($k = 1; $k <= 10; $k++) {
            $trick = new Trick();
            $trick->setName($faker->words(2, true));
            $trick->setContent($faker->paragraph);
            shuffle($userArray);
            $trick->setUser($userArray[0]);
            $trick->setCreatedAt($faker->dateTimeBetween('-3 month', 'now'));
            shuffle($trickGroupArray);
            $trickGroup = $trickGroupArray[0];
            $trick->addTrickGroup($trickGroup);
            $trickGroup->addTrick($trick);

            $manager->persist($trick);
            $manager->persist($trickGroup);

            $now = new \DateTime();
            $interval = $now->diff($trick->getCreatedAt())->days;

            for ($l = 1; $l <= random_int(3,6); $l++){
                $comment = new Comment();
                $comment->setTrick($trick);
                $comment->setCreatedAt($faker->dateTimeBetween('-'.$interval.' days'));
                shuffle($userArray);
                $comment->setUser($userArray[0]);
                $comment->setContent($faker->sentences(random_int(2,6), true));

                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}
