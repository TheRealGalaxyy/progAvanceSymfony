<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Repository\BurgerRepository;
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

    #[Route('/burgers/{id}/delete', name: 'burger_delete')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $burger = $entityManager->getRepository(Burger::class)->find($id);

        if (!$burger) {
            throw $this->createNotFoundException('Le burger avec l\'ID ' . $id . ' n\'existe pas.');
        }

        $entityManager->remove($burger);
        $entityManager->flush();

        return new Response('Burger supprimé avec succès !');
    }

    #[Route('/burgers/{field}/{name}', name: 'burgers_by_ingredient')]
    public function byIngredient(string $field, string $name, BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findByIngredient($field, $name);

        return $this->render('burger/by_ingredient.html.twig', [
            'burgers' => $burgers,
            'ingredientType' => $field,
            'ingredientName' => $name,
        ]);
    }

    #[Route('/burgers/price', name: 'burgers_by_price')]
    public function fiveBurgersByPrice(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->fiveBurgersByPrice();

        return $this->render('burger/price.html.twig', [
            'burgers' => $burgers,
        ]);
    }

}
