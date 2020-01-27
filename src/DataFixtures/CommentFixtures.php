<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $trickArray = $manager->getRepository('App\Entity\Trick')->findAll();
        $userArray = $manager->getRepository('App\Entity\User')->findAll();

        foreach ($trickArray as $trick)
        {
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
    }
}