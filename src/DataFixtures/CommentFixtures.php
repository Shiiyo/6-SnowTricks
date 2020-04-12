<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $trickArray = $manager->getRepository('App\Entity\Trick')->findAll();
        $userArray = $manager->getRepository('App\Entity\User')->findAll();

        foreach ($trickArray as $trick) {
            $now = new \DateTime();
            $interval = $now->diff($trick->getCreatedAt())->days;

            for ($l = 1; $l <= random_int(10, 20); ++$l) {
                $comment = new Comment();
                $comment->setTrick($trick);
                $comment->setCreatedAt($faker->dateTimeBetween('-'.$interval.' days'));
                $comment->setUser($faker->randomElement($userArray));
                $comment->setContent($faker->sentences(random_int(2, 6), true));

                $manager->persist($comment);
            }
        }
    }
}
