<?php

namespace App\DataFixtures;

use App\Entity\Avatar;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->passwordHasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $avatarRepo = $manager->getRepository(Avatar::class);
        $avatar = $avatarRepo->findOneBy(["name" => "Default"]);

        // ? USER
        $user = new User();
        $user->setEmail("user@user.com");
        
        $plaintextPassword = "user";
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setFirstName('User');
        $user->setLastName('User');
        $user->setRoles(['ROLE_USER']);
        $user->setAvatar($avatar);

        $manager->persist($user);

        // ? MANAGER
        $user = new User();
        $user->setEmail("manager@user.com");
        $plaintextPassword = "manager";
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setFirstName('Manager');
        $user->setLastName('Manager');
        $user->setRoles(['ROLE_MANAGER']);
        $user->setAvatar($avatar);

        $manager->persist($user);

        // ? ADMIN
        $user = new User();
        $user->setEmail("admin@user.com");
        
        $plaintextPassword = "admin";
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setFirstName('Admin');
        $user->setLastName('Admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setAvatar($avatar);

        $manager->persist($user);

        $manager->flush();

        // ? SUPER ADMIN
        $user = new User();
        $user->setEmail("superadmin@user.com");

        $plaintextPassword = "superadmin";
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $user->setFirstName("SuperAdmin");
        $user->setLastName("SuperAdmin");
        $user->setRoles(['ROLE_SUPERADMIN']);
        $user->setAvatar($avatar);

        $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AvatarFixtures::class];
    }
}
