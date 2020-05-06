<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

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
      'Stalefish',
      'FS 720',
      'Backside Rodeo 1080',
      'Cork',
      'Rodeo',
      'Tail slide',
      'Backside Triple Cork 1440',
      'Method Air',
      'Double Backflip One Foot',
      'Double Mc Twist 1260',
      'Double Backside Rodeo 1080',
      'Switch',
      'Crippler',
      '270',
      'Backside air',
      'Mc Twist',
      'Crippler',
      'Air to fakie',
      'Handplant',
      'Revert',
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

            $slugCreator = new AsciiSlugger();
            $slug = $slugCreator->slug($name);
            $trick->setSlug($slug);

            $trick->setContent($faker->paragraphs(5, true));
            $trick->setUser($faker->randomElement($userArray));
            $createdAt = $faker->dateTimeBetween('-3 month', 'now');
            $trick->setCreatedAt($createdAt);
            $trick->setUpdatedAt($faker->dateTimeBetween($createdAt, 'now'));
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
