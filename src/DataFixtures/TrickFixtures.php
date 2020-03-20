<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use App\SlugCreator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrickFixtures extends Fixture
{
    private $names = [
      'Mute',
      'Tail grab',
      'Nose grab',
      'Seat belt',
      'Slide',
      'Nose slide',
      'Front-360',
      'Front-flip',
      'Back-flip',
      '1620',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $userArray = $manager->getRepository('App\Entity\User')->findAll();
        $trickGroupArray = $manager->getRepository('App\Entity\TrickGroup')->findAll();

        //Create tricks and comment in each trick
        foreach ($this->getNames() as $name) {
            $trick = new Trick();
            $trick->setName($name);

            $slugCreator = new SlugCreator();
            $slug = $slugCreator->slugify($name);
            $trick->setSlug($slug);

            $trick->setContent($faker->paragraphs(5, true));
            $trick->setUser($faker->randomElement($userArray));
            $trick->setCreatedAt($faker->dateTimeBetween('-3 month', 'now'));
            $trickGroup = $faker->randomElement($trickGroupArray);
            $trick->setTrickGroup($trickGroup);
            $trickGroup->addTrick($trick);

            $manager->persist($trick);
            $manager->persist($trickGroup);
        }
    }

    public function getNames(): array
    {
        return $this->names;
    }
}
