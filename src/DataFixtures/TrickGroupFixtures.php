<?php

namespace App\DataFixtures;

use App\Entity\TrickGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrickGroupFixtures extends Fixture
{
    private $groups = [
        'Grabs',
        'Rotation',
        'Slides',
        'Flips',
    ];

    public function load(ObjectManager $manager)
    {
        //Create 8 trick_group
        foreach ($this->getGroups() as $group) {
            $trickGroup = new TrickGroup();
            $trickGroup->setName($group);

            $manager->persist($trickGroup);
        }
    }

    public function getGroups(): array
    {
        return $this->groups;
    }
}
