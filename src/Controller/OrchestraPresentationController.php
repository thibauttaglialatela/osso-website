<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/orchestra/presentation', name: 'app_')]
class OrchestraPresentationController extends AbstractController
{
    #[Route('/', name: 'orchestra_presentation')]
    public function index(): Response
    {
        return $this->render('orchestra_presentation/index.html.twig', [
            'controller_name' => 'OrchestraPresentationController',
        ]);
    }
}
