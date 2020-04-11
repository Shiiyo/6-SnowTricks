<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
    private $picturesArray = [
        '1.jpeg',
        '2.jpeg',
        '3.jpeg',
        '4.jpeg',
        '5.jpeg',
        '6.jpeg',
        '7.jpeg',
        '8.jpeg',
        '9.jpeg',
        '10.jpeg',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        $trickArray = $manager->getRepository('App\Entity\Trick')->findAll();

        for ($k = 1; $k <= 20; ++$k) {
            $picture = new Picture();

            $trick = $faker->randomElement($trickArray);
            $picture->setTrick($trick);

            if (null == $trick->getFrontPicture()) {
                $trick->setFrontPicture($picture);
            }
            $picture->setFile($faker->randomElement($this->getPicturesArray()));

            $manager->persist($picture);
            $manager->persist($trick);
        }
    }

    public function getPicturesArray(): array
    {
        return $this->picturesArray;
    }
}
