<?php

namespace App\DataFixtures;

use App\Entity\Burger;
use App\Entity\Pain;
use App\Entity\Oignon;
use App\Entity\Sauce;
use App\Entity\Image;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pains = [];
        foreach (['Sésame', 'Brioche', 'Complet', 'Classique'] as $typePain) {
            $pain = new Pain();
            $pain->setName($typePain);
            $manager->persist($pain);
            $pains[] = $pain;
        }

        $oignons = [];
        foreach (['Rouges', 'Blancs', 'Caramélisés'] as $typeOignon) {
            $oignon = new Oignon();
            $oignon->setName($typeOignon);
            $manager->persist($oignon);
            $oignons[] = $oignon;
        }

        $sauces = [];
        foreach (['Ketchup', 'Mayonnaise', 'BBQ', 'Samouraï'] as $typeSauce) {
            $sauce = new Sauce();
            $sauce->setName($typeSauce);
            $manager->persist($sauce);
            $sauces[] = $sauce;
        }

        $burgerData = [
            ['Classic Burger', 5.99, 'Un burger classique avec steak de bœuf, salade, tomate et fromage.'],
            ['Cheese Burger', 6.99, 'Un burger généreux garni de cheddar fondant et de cornichons.'],
            ['Bacon Burger', 7.99, 'Un burger gourmand avec bacon croustillant et sauce BBQ.'],
            ['Veggie Burger', 6.50, 'Un burger végétarien à base de galette de pois chiches et sauce yaourt.'],
            ['Spicy Chicken Burger', 7.20, 'Un burger épicé avec filet de poulet pané, salade croquante et sauce piquante.'],
        ];

        foreach ($burgerData as [$name, $price, $desc]) {
            $burger = new Burger();
            $burger->setName($name);
            $burger->setPrice($price);
            $burger->setDescription($desc);

            $burger->setPain($pains[array_rand($pains)]);

            shuffle($oignons);
            $burger->addOignon($oignons[0]);
            if (rand(0,1)) {
                $burger->addOignon($oignons[1]);
            }

            shuffle($sauces);
            $burger->addSauce($sauces[0]);
            if (rand(0,1)) {
                $burger->addSauce($sauces[1]);
            }

            $image = new Image();
            $image->setName("https://burgeraddict.fr/wp-content/uploads/2024/09/MSG-Smash-Burger-FT-RECIPE0124-d9682401f3554ef683e24311abdf342b.jpg");
            $manager->persist($image);
            $burger->setImage($image);

            $commentaire = new Commentaire();
            $commentaire->setName("Super bon burger : " . strtolower($name));
            $manager->persist($commentaire);
            $burger->setCommentaire($commentaire);

            $manager->persist($burger);
        }

        $manager->flush();
    }
}
