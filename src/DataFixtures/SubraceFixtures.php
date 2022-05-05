<?php

namespace App\DataFixtures;

use App\Entity\Race;
use App\Entity\Subrace;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubraceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $raceRepo = $manager->getRepository(Race::class);
        $races = $raceRepo->findAll(); 

        for ($i=0; $i < 10; $i++) { 
            $subrace = new Subrace;

            $subrace->setName($faker->word());
            $subrace->setDescription($faker->sentences(3, true));
            $subrace->setImageUrl("https://picsum.photos/id/".rand(100, 1000)."/200/300");
            $subrace->setStrength($faker->randomDigit());
            $subrace->setDexterity($faker->randomDigit());
            $subrace->setConstitution($faker->randomDigit());
            $subrace->setWisdom($faker->randomDigit());
            $subrace->setIntelligence($faker->randomDigit());
            $subrace->setCharisma($faker->randomDigit());
            $subrace->setTrait($faker->sentence());
            $subrace->setRace($races[rand(0, count($races) - 1)]);

            $manager->persist($subrace);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [RaceFixtures::class];
    }
}
