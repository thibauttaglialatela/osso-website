<?php

namespace App\Controller;

use App\Repository\PressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/press', name: 'press_')]
class PressController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PressRepository $pressRepository): Response
    {
        $press = $pressRepository->findBy([], ['article_date' => 'DESC'], 3);
        if (!$press) {
            throw $this->createNotFoundException('Aucun article de presse dans la base');
        }

        return $this->render('press/index.html.twig', [
            'press_articles' => $press,
        ]);
    }
}
