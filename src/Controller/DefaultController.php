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

    #[Route('legal', name: 'legal')]
    public function showLegal(): Response
    {
        return $this->render('legal.html.twig');
    }

    #[Route('privacy', name: 'privacy')]
    public function showPrivacy(): Response
    {
        return $this->render('privacy.html.twig');
    }
}
