<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $picturesArray = [
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '4.jpg',
            '5.jpg',
            '6.jpg',
            '7.jpg',
            '8.jpg',
            '9.jpg',
            '10.jpg',
        ];

        $faker = \Faker\Factory::create('fr_FR');
        $trickArray = $manager->getRepository('App\Entity\Trick')->findAll();

        for ($k = 1; $k <= 20; ++$k) {
            $picture = new Picture();

            $trick = $faker->randomElement($trickArray);
            $picture->setTrick($trick);

            if (null == $trick->getFrontPicture()) {
                $trick->setFrontPicture($picture);
            }
            $picture->setFile($faker->randomElement($picturesArray));

            $manager->persist($picture);
            $manager->persist($trick);
        }
    }
}
