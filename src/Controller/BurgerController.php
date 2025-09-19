<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Commentaire;
use App\Entity\Image;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burger_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $burgers = $doctrine->getRepository(Burger::class)->findAll();

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burgers/create', name: 'burger_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $burger = new Burger();
        $burger->setName('VIP Burger');
        $burger->setPrice(10.99);
        $burger->setDescription('Seulement le meilleur pour nos clients VIP.');
    
        $entityManager->persist($burger);
        $entityManager->flush();
    
        return new Response('Burger créé avec succès !');
    }
}
