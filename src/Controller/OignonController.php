<?php

namespace App\Controller;

use App\Entity\Oignon;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OignonController extends AbstractController
{
    #[Route('/oignons', name: 'oignon_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $oignons = $doctrine->getRepository(Oignon::class)->findAll();

        return $this->render('oignon/index.html.twig', [
            'oignons' => $oignons,
        ]);
    }
}
