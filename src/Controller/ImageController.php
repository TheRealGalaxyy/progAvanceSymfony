<?php

namespace App\Controller;

use App\Entity\Image;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/images', name: 'image_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $images = $doctrine->getRepository(Image::class)->findAll();

        return $this->render('images/index.html.twig', [
            'images' => $images,
        ]);
    }
}
