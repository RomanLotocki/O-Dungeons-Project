<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Race;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 4; $i++) {
            $race = new Race();
            $race->setName($faker->word());
            $race->setFullDescription($faker->paragraph());
            $race->setQuickDescription($faker->sentence());

            $manager->persist($race);
        }
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}