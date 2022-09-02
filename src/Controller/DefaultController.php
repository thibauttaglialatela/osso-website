<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_')]
class DefaultController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'website' => 'OSSO',
        ]);
    }

    #[Route('rgpd', name: 'rgpd')]
    public function showRGPD(): Response
    {
        return $this->render('rgpd.html.twig');
    }
}
