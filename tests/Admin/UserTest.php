<?php

namespace App\Tests\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends WebTestCase
{
    public function testAccessHomeAdmin(): void
    {
        // Let's test if an unauthenticated user is redirected to the login page
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/');

        $this->assertResponseRedirects("/login");

        // Let's test if someone with ROLE_USER doesn't have access to the backoffice pages
        $userRepo = static::getContainer()->get(UserRepository::class);
        $user = $userRepo->findOneBy(["email" => "user@user.com"]);
        
        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/');

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);        
        
        // Let's test if someone with MANAGER_ROLE can access the backoffice
        $user = $userRepo->findOneBy(["email" => "manager@user.com"]);

        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Let's test if someone with ADMIN_ROLE can access the backoffice
        $user = $userRepo->findOneBy(["email" => "admin@user.com"]);

        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Let's test if someone with SUPERADMIN_ROLE can access the backoffice
        $user = $userRepo->findOneBy(["email" => "superadmin@user.com"]);

        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
