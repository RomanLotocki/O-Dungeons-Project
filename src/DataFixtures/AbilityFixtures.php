<?php

namespace App\DataFixtures;

use App\Entity\Ability;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AbilityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        for ($i=0; $i < 50; $i++) { 
            $ability = new Ability;
            $ability->setName($faker->word());
            $ability->setQuickDescription($faker->sentences(3, true));
            $ability->setDescription($faker->sentences(12, true));
            $ability->setIncantationTime($faker->randomElement(['Instantané', '1 tour', '2 tours', '3 tours']));
            $ability->setAbilityRange($faker->randomElement(['2m', '3m', 'CaC']));
            $ability->setComponent($faker->word());
            $ability->setDuration($faker->randomElement(['Instantané', '1 tour', '2 tours', '3 tours']));
            
            $manager->persist($ability);
        }

        $manager->flush();
    }
}
