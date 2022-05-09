<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $item1 = new Item;
        $item1->setName('Accessoires de déguisement');
        $item1->setWeight(1.5);

        $manager->persist($item1);

        $item2 = new Item;
        $item2->setName('Barde');
        $item2->setWeight(1.5);

        $manager->persist($item2);

        $manager->flush();
    }
}
