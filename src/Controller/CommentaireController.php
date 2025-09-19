<?php

namespace App\Controller;

use App\Entity\Commentaire;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    #[Route('/commentaires', name: 'commentaire_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $commentaires = $doctrine->getRepository(Commentaire::class)->findAll();

        return $this->render('commentaires/index.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }
}
