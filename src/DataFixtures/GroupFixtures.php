<?php

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{
    const HIGH_TECH_GROUP_REF = "high_tech_group";

    public function load(ObjectManager $manager)
    {
        $group = new Group();
        $group->setName('High-tech');

        $manager->persist($group);
        $manager->flush();
        $this->addReference(self::HIGH_TECH_GROUP_REF, $group);
    }

}
