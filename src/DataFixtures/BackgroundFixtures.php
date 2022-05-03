<?php

namespace App\DataFixtures;

use App\Entity\Item;
use App\Entity\Background;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BackgroundFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $itemRepo = $manager->getRepository(Item::class);
        $items = $itemRepo->findAll(); 

        for ($i=0; $i < 6; $i++) { 
            $background = new Background;

            $background->setName($faker->word());
            $background->setCapacities($faker->word());
            $background->setNbLanguage($faker->randomDigit());
            $background->setDescription($faker->paragraph());
            
            for ($i=1; $i < rand(2, 6); $i++) {
                $background->addItem($items[$faker->unique()->numberBetween(0, count($items) - 1)]);
            }

            $manager->persist($background);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ItemFixtures::class];
    }
}
