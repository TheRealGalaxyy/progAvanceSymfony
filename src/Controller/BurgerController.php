<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burgers_list')]
    public function list(): Response
    {
        $burgers = $this->getBurgers();

        return $this->render('burgers_list.html.twig', ['burgers' => $burgers]);
    }
    #[Route('/burgers/{id}', name: 'burger_detail')]
    public function show($id): Response
    {

        $burgers = $this->getBurgers();

        if (!isset($burgers[$id])) {
            throw $this->createNotFoundException('Burger not found');
        }

        return $this->render('burger_detail.html.twig', ['burger' => $burgers[$id]]);
    }

    public function getBurgers()
    {
        $burgers = [
            [
                'id' => 1,
                'name' => 'Classic Burger',
                'price' => 5.99,
                'description' => 'Un burger classique avec steak de bœuf, salade, tomate et fromage.'
            ],
            [
                'id' => 2,
                'name' => 'Cheese Burger',
                'price' => 6.99,
                'description' => 'Un burger généreux garni de cheddar fondant et de cornichons.'
            ],
            [
                'id' => 3,
                'name' => 'Bacon Burger',
                'price' => 7.99,
                'description' => 'Un burger gourmand avec bacon croustillant et sauce BBQ.'
            ],
            [
                'id' => 4,
                'name' => 'Boogie Burger',
                'price' => 4.00,
                'description' => 'Un burger fun avec un mélange d’épices maison surprenant.'
            ],
            [
                'id' => 5,
                'name' => 'Veggie Burger',
                'price' => 6.50,
                'description' => 'Un burger végétarien à base de galette de pois chiches et sauce yaourt.'
            ],
            [
                'id' => 6,
                'name' => 'Double Cheese Burger',
                'price' => 8.50,
                'description' => 'Deux steaks de bœuf, double fromage, un vrai classique américain.'
            ],
            [
                'id' => 7,
                'name' => 'Spicy Chicken Burger',
                'price' => 7.20,
                'description' => 'Un burger épicé avec filet de poulet pané, salade croquante et sauce piquante.'
            ],
            [
                'id' => 8,
                'name' => 'Fish Burger',
                'price' => 6.80,
                'description' => 'Un filet de poisson croustillant, salade et sauce tartare maison.'
            ],
        ];

        $burgersById = [];
        foreach ($burgers as $burger) {
            $burgersById[$burger['id']] = $burger;
        }

        return $burgersById;
    }
}
