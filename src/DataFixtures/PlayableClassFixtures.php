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
    
        // ? Barde
        $barde = new PlayableClass;
        $barde->setName("Barde");
        $barde->setDescription("....");
        $barde->setLifeDice("1d8");
        $barde->setImageUrl("https://picsum.photos/id/".rand(100, 1000)."/200/300");
        $barde->addArmor($armorRepo->findOneBy(["name" => "Cuir"]));
        $barde->addWeapon($weaponRepo->findOneBy(["name" => "Rapière"]));
        $barde->addWeapon($weaponRepo->findOneBy(["name" => "Dague"]));
        // abilities level 0
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Illusion mineure"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Lumière"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Main du mage"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Moquerie cruelle"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Prestidigitation"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Réparation"]));
        // abilities level 1
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Charme-personne"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Compréhension des langues"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Déguisement"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Détection de la magie"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Feuille morte"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Grande foulée"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Identification"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Image silencieuse"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Lueurs féeriques"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Mot de guérison"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Soins"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Sommeil"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Vague tonnante"]));
        // abilities level 2
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Déblocage"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Fracassement"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Immobilisation de personne"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Invisibilité"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Restauration partielle"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Silence"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Suggestion"]));
        // abilities level 3
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Communication à distance"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Dissipation de la magie"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Image majeure"]));
        $barde->addAbility($abilityRepo->findOneBy(["name" => "Terreur"]));
    
        $manager->persist($barde);
    
        // ? Clerc
        $clerc = new PlayableClass;
        $clerc->setName("Clerc");
        $clerc->setDescription("....");
        $clerc->setLifeDice("1d8");
        $clerc->setImageUrl("https://picsum.photos/id/".rand(100, 1000)."/200/300");
        $clerc->addArmor($armorRepo->findOneBy(["name" => "Ecailles"]));
        $clerc->addArmor($armorRepo->findOneBy(["name" => "Bouclier"]));
        $clerc->addWeapon($weaponRepo->findOneBy(["name" => "Masse d'armes"]));
        $clerc->addWeapon($weaponRepo->findOneBy(["name" => "Arbalete légère"]));
        // abilities level 0
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Assistance"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Flamme sacrée"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Lumière"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Réparation"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Résistance"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Thaumaturgie"]));
        // abilities level 1
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Bénédiction"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Blessure"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Bouclier de la foi"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Détection de la magie"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Injonction"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Mot de guérison"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Rayon traçant"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Sanctuaire"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Soins"]));
        // abilities level 2
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Aide"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Arme spirituelle"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Augure"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Immobilisation de personne"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Lien de protection"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Restauration partielle"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Silence"]));
        // abilities level 3
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Délivrance des malédictions"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Dissipation de la magie"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Esprits gardiens"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Lueur d'espoir"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Mot de guérison de groupe"]));
        $clerc->addAbility($abilityRepo->findOneBy(["name" => "Retour à la vie"]));

        $manager->persist($clerc);

        // ? Guerrier
        $guerrier = new PlayableClass;
        $guerrier->setName("Guerrier");
        $guerrier->setDescription("....");
        $guerrier->setLifeDice("1d10");
        $guerrier->setImageUrl("https://picsum.photos/id/".rand(100, 1000)."/200/300");
        $guerrier->addArmor($armorRepo->findOneBy(["name" => "Cotte de mailles"]));
        $guerrier->addArmor($armorRepo->findOneBy(["name" => "Bouclier"]));
        $guerrier->addWeapon($weaponRepo->findOneBy(["name" => "Épée longue"]));
        $guerrier->addWeapon($weaponRepo->findOneBy(["name" => "Arbalete légère"]));

        $manager->persist($guerrier);

        // ? Magicien
        $magicien = new PlayableClass;
        $magicien->setName("Magicien");
        $magicien->setDescription("....");
        $magicien->setLifeDice("1d6");
        $magicien->setImageUrl("https://picsum.photos/id/".rand(100, 1000)."/200/300");
        $magicien->addWeapon($weaponRepo->findOneBy(["name" => "Bâton"]));
        // abilities level 0
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Aspersion acide"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Bouffée de poison"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Illusion mineure"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Lumière"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Lumières dansantes"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Main du mage"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Poigne électrique"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Prestidigitation"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Rayon de givre"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Trait de feu"]));
        // abilities level 1
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Armure du mage"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Bouclier"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Charme-personne"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Compréhension des langues"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Déguisement"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Détection de la magie"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Feuille morte"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Grande foulée"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Identification"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Image silencieuse"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Mains brûlantes"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Projectile magique"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Sommeil"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Vague tonnante"]));
        // abilities level 2
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Arme magique"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Déblocage"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Flou"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Foulée brumeuse"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Fracassement"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Immobilisation de personne"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Invisibilité"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Lévitation"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Pattes d'araignée"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Sphère de feu"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Suggestion"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Ténèbres"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Toile d'araignée"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Verrou magique"]));
        // abilities level 3
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Boule de feu"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Dissipation de la magie"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Éclair"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Hâte"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Image majeure"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Terreur"]));
        $magicien->addAbility($abilityRepo->findOneBy(["name" => "Vol"]));

        $manager->persist($magicien);

        // ? Roublard
        $roublard = new PlayableClass;
        $roublard->setName("Roublard");
        $roublard->setDescription("....");
        $roublard->setLifeDice("1d8");
        $roublard->setImageUrl("https://picsum.photos/id/".rand(100, 1000)."/200/300");
        $roublard->addWeapon($weaponRepo->findOneBy(["name" => "Rapière"]));
        $roublard->addWeapon($weaponRepo->findOneBy(["name" => "Arc court"]));
        $roublard->addWeapon($weaponRepo->findOneBy(["name" => "Dague"]));
        $roublard->addArmor($armorRepo->findOneBy(["name" => "Cuir"]));

        $manager->persist($roublard);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AbilityFixtures::class,
                ArmorFixtures::class,
                WeaponFixtures::class];
    }
}
