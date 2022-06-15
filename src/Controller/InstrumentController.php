<?php

namespace App\Controller;


use App\Entity\Musician;
use App\Repository\InstrumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstrumentController extends AbstractController
{
    #[Route('orchestra/instrument', name: 'orchestra_instrument')]
    public function index(InstrumentRepository $instrumentRepository): Response
    {
        $instruments = $instrumentRepository->findAll();


        return $this->render('instrument/index.html.twig', [
            'instruments' => $instruments,
        ]);
    }

    #[Route('Orchestra/instrument/musician/{id}', name: 'orchestra_instrument_musician')]
    public function show(Musician $musician): Response
    {
        return $this->render('instrument/index.html.twig', [
            'musicians' => $musician,
        ]);
    }
}
