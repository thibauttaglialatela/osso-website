<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicianController extends AbstractController
{
    #[Route('/musician', name: 'app_musician')]
    public function index(): Response
    {
        return $this->render('musician/index.html.twig', [
            'controller_name' => 'MusicianController',
        ]);
    }
}
