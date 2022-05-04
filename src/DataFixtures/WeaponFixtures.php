<?php

namespace App\DataFixtures;

use App\Entity\Weapon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WeaponFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        for ($i=0; $i < 50; $i++) { 
            $weapon = new Weapon;
            $weapon->setName($faker->word());
            $weapon->setType($faker->word());
            $weapon->setDamageDice($faker->randomElement(["1d6", "1d4", "1d8", "2d4"]));
            $weapon->setDamageType($faker->randomElement(["feu", "glace", "contondant"]));
            $weapon->setWeight($faker->randomFloat(1, 0, 15));
            $weapon->setProperty($faker->word());

            $manager->persist($weapon);
        }

        $manager->flush();
    }
}
