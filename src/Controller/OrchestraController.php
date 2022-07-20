<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/orchestra/', name: 'orchestra_')]
class OrchestraController extends AbstractController
{
    #[Route('presentation/', name: 'presentation')]
    public function index(): Response
    {
        return $this->render('orchestra_presentation/index.html.twig');
    }
}
