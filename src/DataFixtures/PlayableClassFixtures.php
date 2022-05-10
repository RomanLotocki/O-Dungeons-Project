<?php

namespace App\DataFixtures;

use App\Entity\PlayableClass;
use App\Entity\Ability;
use App\Entity\Armor;
use App\Entity\Subclass;
use App\Entity\Weapon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlayableClassFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $abilityRepo = $manager->getRepository(Ability::class);
        $armorRepo = $manager->getRepository(Armor::class);
        $weaponRepo = $manager->getRepository(Weapon::class);
    
        $barde = new PlayableClass;
        $barde->setName("Barde");
        $barde->setDescription("....");
        $barde->setLifeDice("1d8");
        $barde->setImageUrl("https://picsum.photos/id/".rand(100, 1000)."/200/300");
        $barde->addArmor($armorRepo->findOneBy(["name" => "Cuir"]));
        $barde->addWeapon($weaponRepo->findOneBy(["name" => "Rapière"]));
        $barde->addWeapon($weaponRepo->findOneBy(["name" => "Dague"]));
    
        $manager->persist($barde);
    

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AbilityFixtures::class,
                ArmorFixtures::class,
                WeaponFixtures::class];
    }
}
