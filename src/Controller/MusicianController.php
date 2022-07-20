<?php

namespace App\Controller;

use App\Repository\InstrumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicianController extends AbstractController
{
    #[Route('orchestra/instrument/{id}/musicians', name: 'instrument_musician')]
    public function show(InstrumentRepository $instrumentRepository, int $id): Response
    {
        $instrument = $instrumentRepository->find($id);

        return $this->render('musician/_musicians_instrument.html.twig', [
            'instrument' => $instrument,
        ]);
    }
}
