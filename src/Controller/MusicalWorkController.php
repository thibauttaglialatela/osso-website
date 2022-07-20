<?php

namespace App\Controller;

use App\Repository\MusicalWorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicalWorkController extends AbstractController
{
    #[Route('/musical/work', name: 'orchestra_musical_work')]
    public function index(MusicalWorkRepository $musicalWorkRepository): Response
    {
        return $this->render('musical_work/index.html.twig', [
            'repertory' => $musicalWorkRepository->findAll(),
        ]);
    }
}
