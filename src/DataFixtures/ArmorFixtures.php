<?php

namespace App\DataFixtures;

use App\Entity\Armor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArmorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 50; $i++) { 
            $armor = new Armor;

            $armor->setName($faker->word);
            $armor->setArmorType($faker->word);
            $armor->setArmorClass($faker->word);
            $armor->setStrength($faker->randomDigit);
            $armor->setDiscretion($faker->randomElement(['Désavantage', 'Avantage']));
            $armor->setWeight($faker->randomFloat(1, 0, 15));

            $manager->persist($armor);
        }

        $manager->flush();
    }
}
