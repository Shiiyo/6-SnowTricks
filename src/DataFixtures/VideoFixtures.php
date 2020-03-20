<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture
{
    private $nameArray = [
        'SQyTWk7OxSI',
        'G9qlTInKbNE',
        'qsd8uaex-Is',
        'bA6HZin1VyI',
        'SqpVHk2O778',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        $trickArray = $manager->getRepository('App\Entity\Trick')->findAll();

        for ($k = 1; $k <= 10; ++$k) {
            $video = new Video();

            $video->setTrick($faker->randomElement($trickArray));

            $video->setName($faker->randomElement($this->getNameArray()));

            $video->setHostName('youtube');

            $manager->persist($video);
        }
    }

    public function getNameArray(): array
    {
        return $this->nameArray;
    }
}
