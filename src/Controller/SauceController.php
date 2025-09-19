<?php

namespace App\Controller;

use App\Entity\Sauce;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SauceController extends AbstractController
{
    #[Route('/sauces', name: 'sauce_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $sauces = $doctrine->getRepository(Sauce::class)->findAll();

        return $this->render('sauce/index.html.twig', [
            'sauces' => $sauces,
        ]);
    }
}
