<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 50; $i++) { 
            $item = new Item;

            $item->setName($faker->word);
            $item->setWeight($faker->randomFloat(1, 0, 15));

            $manager->persist($item);
        }

        $manager->flush();
    }
}
