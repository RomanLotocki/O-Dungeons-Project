<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Avatar;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AvatarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $avatar = new Avatar;
        $avatar->setName("Default");
        $avatar->setImageUrl("https://www.kindpng.com/picc/m/421-4212275_transparent-default-avatar-png-avatar-img-png-download.png");

        $manager->persist($avatar);

        for ($i=0; $i < 10; $i++) {
            $avatar = new Avatar();
            $avatar->setName($faker->lastName());
            $avatar->setImageUrl("https://picsum.photos/id/".rand(100, 1000)."/200/300");

            $manager->persist($avatar);
        }
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
