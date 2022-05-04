<?php

namespace App\DataFixtures;

use App\Entity\Subclass;
use App\Entity\PlayableClass;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubclassFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $playableClassRepo = $manager->getRepository(PlayableClass::class);
        $classes = $playableClassRepo->findAll(); 

        for ($i=0; $i < 15; $i++) { 
            $subclass = new Subclass;

            $subclass->setName($faker->word());
            $subclass->setDescription($faker->sentences(3, true));
            $subclass->setPlayableClass($classes[rand(0, count($classes) - 1)]);

            $manager->persist($subclass);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [PlayableClassFixtures::class];
    }
}
