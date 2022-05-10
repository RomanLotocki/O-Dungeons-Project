<?php

namespace App\DataFixtures;

use App\Entity\Item;
use App\Entity\PlayableClass;
use App\Entity\PlayableClassItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlayableClassItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $playableClassRepo = $manager->getRepository(PlayableClass::class);
        $itemRepo = $manager->getRepository(Item::class);

        /** Barde */
        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Corne (Instrument de musique)"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Coffre"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(2);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Étui à cartes ou à parchemins"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Vêtements de qualité"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Encre (bouteille de 30 cl)"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Porte-plume"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Lampe"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(2);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Huile (flasque)"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(5);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Papier (la feuille)"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Parfum (flacon)"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Cire à cacheter"]));

        $manager->persist($relation);

        $relation = new PlayableClassItem;
        $relation->setQuantity(1);
        $relation->setPlayableClass($playableClassRepo->findOneBy(["name" => "Barde"]));
        $relation->setItem($itemRepo->findOneBy(["name" => "Savon"]));

        $manager->persist($relation);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ItemFixtures::class,
                PlayableClassFixtures::class];
    }
}
