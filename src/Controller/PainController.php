<?php

namespace App\Controller;

use App\Entity\Pain;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PainController extends AbstractController
{
    #[Route('/pains', name: 'pain_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $pains = $doctrine->getRepository(Pain::class)->findAll();

        return $this->render('pain/index.html.twig', [
            'pains' => $pains,
        ]);
    }
}
