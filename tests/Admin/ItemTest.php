<?php

namespace App\Tests\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ItemTest extends WebTestCase
{
    public function testCreate(): void
    {
        $client = static::createClient();

        $userRepo = static::getContainer()->get(UserRepository::class);
        $user = $userRepo->findOneBy(["email" => "manager@user.com"]);

        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/objet/ajouter');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');

        $button = $crawler->selectButton('Sauvegarder');
        
        $form = $button->form();

        // Should work        
        
        $form['item[name]'] = 'Baton';
        $form['item[weight]'] =  5.5;

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_SEE_OTHER);

        // Should not work

        $form['item[name]'] = 'Baton';
        $form['item[weight]'] = 'Cinq virgule cinq kilo';

        $client->submit($form);

        $this->assertResponseIsUnprocessable();

        $form['item[name]'] = 'iufhnbviszughvbuiysghbvesuygvhbuyhgvhbuyghbvuy_sgdbvuesruivghbuvgbuyvguisyvgbuvhgbuysgvbcujhvbuzsogvusxdoygvbuzsyqgvcxyuhvbgzuygvcjighsdvuiyzbgvuygbxccvuygzsouvghousyvgboyuhgfuysgvbuojqghbvuoysqdgvbujyhvgbsuyoegfuyscvgbzuyhgvuyvguqygbvuqysgvyuvgbdvfzvdxvvazjhdvjhabkjbxhvkjbadjhavhcvajhdkbcjahzdbjcavzjdhvkabkdj ajzjdka jbakjabjhdfkjabzdkjbajhzdbhj avkjzdbkja bzhjbdjh vajvzdhkba jbkjdbajhzvdk jabzkjdb hjavzkjdbkjkkjbhdbkajzbd jhavfjhevz hajzvdkjav jhafvkh vfazkd';
        $form['item[weight]'] = 5.5;

        $client->submit($form);

        $this->assertResponseIsUnprocessable();
    }
}
