<?php

namespace App\DataFixtures;

use App\Entity\PlayableClass;
use App\Entity\Item;
use App\Entity\Ability;
use App\Entity\Armor;
use App\Entity\Weapon;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlayableClassFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $itemRepo = $manager->getRepository(Item::class);
        $items = $itemRepo->findAll();
        $abilityRepo = $manager->getRepository(Ability::class);
        $abilities = $abilityRepo->findAll();
        $armorRepo = $manager->getRepository(Armor::class);
        $armors = $armorRepo->findAll();
        $weaponRepo = $manager->getRepository(Weapon::class);
        $weapons = $weaponRepo->findAll();

        for ($i=0; $i < 6; $i++) { 
            $playableClass = new PlayableClass;

            $playableClass->setName($faker->word());
            $playableClass->setDescription($faker->sentences(3, true));
            $playableClass->setLifeDice('d'.$faker->randomDigit());
            $playableClass->setImageUrl($faker->url());
            
            for ($j=0; $j < rand(2, 6); $j++) {
                $playableClass->addItem($items[$faker->unique()->numberBetween(0, count($items) - 1)]);
                $playableClass->addAbility($abilities[$faker->unique(true)->numberBetween(0, count($abilities) - 1)]);
                $playableClass->addArmor($armors[$faker->unique(true)->numberBetween(0, count($armors) - 1)]);
                $playableClass->addWeapon($weapons[$faker->unique(true)->numberBetween(0, count($weapons) - 1)]);
            }
            $manager->persist($playableClass);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ItemFixtures::class,
                AbilityFixtures::class,
                ArmorFixtures::class,
                WeaponFixtures::class];
    }
}
