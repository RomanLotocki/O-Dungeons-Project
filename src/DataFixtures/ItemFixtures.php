<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $item1 = new Item;
        $item1->setName('Accessoires de déguisement');
        $item1->setWeight(1.5);
        $manager->persist($item1);

        $item2 = new Item;
        $item2->setName('Barde');
        $item2->setWeight(0);
        $manager->persist($item2);

        $item3 = new Item;
        $item3->setName('Billes (sac de 1 000)');
        $item3->setWeight(1);
        $manager->persist($item3);

        $item4 = new Item;
        $item4->setName('Boîte à amadou');
        $item4->setWeight(0.5);
        $manager->persist($item4);

        $item5 = new Item;
        $item5->setName('Dés (Boîte de jeux)');
        $item5->setWeight(0);
        $manager->persist($item5);

        $item6 = new Item;
        $item6->setName('Echecs draconiques (Boîte de jeux)');
        $item6->setWeight(0.25);
        $manager->persist($item6);

        $item7 = new Item;
        $item7->setName('Jeu de cartes (Boîte de jeux)');
        $item7->setWeight(0);
        $manager->persist($item7);

        $item8 = new Item;
        $item8->setName('Jeu des dragons (Boîte de jeux)');
        $item8->setWeight(0);
        $manager->persist($item8);

        $item9 = new Item;
        $item9->setName('Bougie');
        $item9->setWeight(0);
        $manager->persist($item9);

        $item10 = new Item;
        $item10->setName('Boulier');
        $item10->setWeight(1);
        $manager->persist($item10);

        $item11 = new Item;
        $item11->setName('Bouteille, verre');
        $item11->setWeight(1);
        $manager->persist($item11);

        $item12 = new Item;
        $item12->setName('Cadenas');
        $item12->setWeight(0.5);
        $manager->persist($item12);

        $item13 = new Item;
        $item13->setName('Carquois');
        $item13->setWeight(0.5);
        $manager->persist($item13);

        $item14 = new Item;
        $item14->setName('Chevalière');
        $item14->setWeight(0);
        $manager->persist($item14);

        $item15 = new Item;
        $item15->setName('Cire à cacheter');
        $item15->setWeight(0);
        $manager->persist($item15);

        $item16 = new Item;
        $item16->setName('Cloche');
        $item16->setWeight(0);
        $manager->persist($item16);

        $item17 = new Item;
        $item17->setName('Coffre');
        $item17->setWeight(12.5);
        $manager->persist($item17);

        $item18 = new Item;
        $item18->setName('Corde en chanvre (15 m)');
        $item18->setWeight(5);
        $manager->persist($item18);

        $item19 = new Item;
        $item19->setName('Corde en soie (15 m)');
        $item19->setWeight(2.5);
        $manager->persist($item19);

        $item20 = new Item;
        $item20->setName('Costume');
        $item20->setWeight(2);
        $manager->persist($item20);

        $item21 = new Item;
        $item21->setName('Couverture');
        $item21->setWeight(1.5);
        $manager->persist($item21);

        $item22 = new Item;
        $item22->setName('Craie (1 morceau)');
        $item22->setWeight(0);
        $manager->persist($item22);

        $item23 = new Item;
        $item23->setName('Eau bénite (flasque)');
        $item23->setWeight(0.5);
        $manager->persist($item23);

        $item24 = new Item;
        $item24->setName('Echelle (3 m)');
        $item24->setWeight(12.5);
        $manager->persist($item24);

        $item25 = new Item;
        $item25->setName('Encre (bouteille de 30 cl)');
        $item25->setWeight(0);
        $manager->persist($item25);

        $item26 = new Item;
        $item26->setName('Etui à cartes ou à parchemins');
        $item26->setWeight(0.5);
        $manager->persist($item26);

        $item27 = new Item;
        $item27->setName('Etui pour carreaux (jusqu\'à 20)');
        $item27->setWeight(0.5);
        $manager->persist($item27);

        $item28 = new Item;
        $item28->setName('Fiole');
        $item28->setWeight(0);
        $manager->persist($item28);

        $item29 = new Item;
        $item29->setName('Baguette (Focaliseur arcanique)');
        $item29->setWeight(0.5);
        $manager->persist($item29);

        $item30 = new Item;
        $item30->setName('Bâton (Focaliseur arcanique)');
        $item30->setWeight(2);
        $manager->persist($item30);

        $item31 = new Item;
        $item31->setName('Cristal (Focaliseur arcanique)');
        $item31->setWeight(0.5);
        $manager->persist($item31);

        $item32 = new Item;
        $item32->setName('Orbe (Focaliseur arcanique)');
        $item32->setWeight(1.5);
        $manager->persist($item32);

        $item33 = new Item;
        $item33->setName('Sceptre (Focaliseur arcanique)');
        $item33->setWeight(1);
        $manager->persist($item33);

        $item34 = new Item;
        $item34->setName('Gamelle');
        $item34->setWeight(0.5);
        $manager->persist($item34);

        $item35 = new Item;
        $item35->setName('Grimoire');
        $item35->setWeight(1.5);
        $manager->persist($item35);

        $item36 = new Item;
        $item36->setName('Habit de cérémonie');
        $item36->setWeight(2);
        $manager->persist($item36);

        $item37 = new Item;
        $item37->setName('Huile (flasque)');
        $item37->setWeight(0.5);
        $manager->persist($item37);

        $item38 = new Item;
        $item38->setName('Corne (Instrument de musique)');
        $item38->setWeight(1);
        $manager->persist($item38);

        $item39 = new Item;
        $item39->setName('Cornemuse (Instrument de musique)');
        $item39->setWeight(3);
        $manager->persist($item39);

        $item40 = new Item;
        $item40->setName('Flûte (Instrument de musique)');
        $item40->setWeight(0.5);
        $manager->persist($item40);

        $item41 = new Item;
        $item41->setName('Flûte de pan (Instrument de musique)');
        $item41->setWeight(1);
        $manager->persist($item41);

        $item42 = new Item;
        $item42->setName('Luth (Instrument de musique)');
        $item42->setWeight(1);
        $manager->persist($item42);

        $item43 = new Item;
        $item43->setName('Lyre (Instrument de musique)');
        $item43->setWeight(1);
        $manager->persist($item43);

        $item44 = new Item;
        $item44->setName('Tambour (Instrument de musique)');
        $item44->setWeight(1.5);
        $manager->persist($item44);

        $item45 = new Item;
        $item45->setName('Lampe');
        $item45->setWeight(0.5);
        $manager->persist($item45);

        $item46 = new Item;
        $item46->setName('Lanterne à capote');
        $item46->setWeight(1);
        $manager->persist($item46);

        $item47 = new Item;
        $item47->setName('Lanterne sourde');
        $item47->setWeight(1);
        $manager->persist($item47);

        $item48 = new Item;
        $item48->setName('Livre');
        $item48->setWeight(2.5);
        $manager->persist($item48);

        $item49 = new Item;
        $item49->setName('Marteau');
        $item49->setWeight(1.5);
        $manager->persist($item49);

        $item50 = new Item;
        $item50->setName('Miroir en acier');
        $item50->setWeight(0.25);
        $manager->persist($item50);

        $item51 = new Item;
        $item51->setName('Billes de fronde x20 (Munitions)');
        $item51->setWeight(0.75);
        $manager->persist($item51);

        $item52 = new Item;
        $item52->setName('Carreaux d\'arbalète x20 (Munitions)');
        $item52->setWeight(0.75);
        $manager->persist($item52);

        $item53 = new Item;
        $item53->setName('Flèches x20 (Munitions)');
        $item53->setWeight(0.5);
        $manager->persist($item53);

        $item54 = new Item;
        $item54->setName('Matériel de brasseur (Outils d\'artisan)');
        $item54->setWeight(4.5);
        $manager->persist($item54);

        $item55 = new Item;
        $item55->setName('Matériel de calligraphe (Outils d\'artisan)');
        $item55->setWeight(2.5);
        $manager->persist($item55);

        $item56 = new Item;
        $item56->setName('Matériel de peintre (Outils d\'artisan)');
        $item56->setWeight(2.5);
        $manager->persist($item56);

        $item57 = new Item;
        $item57->setName('Outils de bricoleur (Outils d\'artisan)');
        $item57->setWeight(5);
        $manager->persist($item57);

        $item58 = new Item;
        $item58->setName('Outils de cartographe (Outils d\'artisan)');
        $item58->setWeight(3);
        $manager->persist($item58);

        $item59 = new Item;
        $item59->setName('Outils de charpentier (Outils d\'artisan)');
        $item59->setWeight(3);
        $manager->persist($item59);

        $item60 = new Item;
        $item60->setName('Outils de cordonnier (Outils d\'artisan)');
        $item60->setWeight(2.5);
        $manager->persist($item60);

        $item61 = new Item;
        $item61->setName('Outils de forgeron (Outils d\'artisan)');
        $item61->setWeight(4);
        $manager->persist($item61);

        $item62 = new Item;
        $item62->setName('Outils de joaillier (Outils d\'artisan)');
        $item62->setWeight(1);
        $manager->persist($item62);

        $item63 = new Item;
        $item63->setName('Outils de maçon (Outils d\'artisan)');
        $item63->setWeight(4);
        $manager->persist($item63);

        $item64 = new Item;
        $item64->setName('Outils de menuisier (Outils d\'artisan)');
        $item64->setWeight(2.5);
        $manager->persist($item64);

        $item65 = new Item;
        $item65->setName('Outils de tanneur (Outils d\'artisan)');
        $item65->setWeight(2.5);
        $manager->persist($item65);

        $item66 = new Item;
        $item66->setName('Outils de tisserand (Outils d\'artisan)');
        $item66->setWeight(2.5);
        $manager->persist($item66);

        $item67 = new Item;
        $item67->setName('Ustensiles de cuisinier (Outils d\'artisan)');
        $item67->setWeight(4);
        $manager->persist($item67);

        $item68 = new Item;
        $item68->setName('Outils de voleur');
        $item68->setWeight(0.5);
        $manager->persist($item68);

        $item69 = new Item;
        $item69->setName('Outre (pleine)');
        $item69->setWeight(2.5);
        $manager->persist($item69);

        $item70 = new Item;
        $item70->setName('Panier');
        $item70->setWeight(1);
        $manager->persist($item70);

        $item71 = new Item;
        $item71->setName('Papier (la feuille)');
        $item71->setWeight(0);
        $manager->persist($item71);

        $item72 = new Item;
        $item72->setName('Parchemin (la feuille)');
        $item72->setWeight(0);
        $manager->persist($item72);

        $item73 = new Item;
        $item73->setName('Parfum (flacon)');
        $item73->setWeight(0);
        $manager->persist($item73);


        $manager->flush();
    }
}
