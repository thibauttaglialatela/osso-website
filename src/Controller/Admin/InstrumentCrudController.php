<?php

namespace App\Controller\Admin;

use App\Entity\Instrument;
use App\Form\InstrumentType;
use App\Repository\InstrumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/instrument/crud', name: 'app_instrument_crud_')]
class InstrumentCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(InstrumentRepository $instrumentRepository): Response
    {
        return $this->render('/admin/instrument_crud/index.html.twig', [
            'instruments' => $instrumentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, InstrumentRepository $instrumentRepository): Response
    {
        $instrument = new Instrument();
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $instrumentRepository->add($instrument, true);

            return $this->redirectToRoute('app_instrument_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/instrument_crud/new.html.twig', [
            'instrument' => $instrument,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Instrument $instrument): Response
    {
        return $this->render('/admin/instrument_crud/show.html.twig', [
            'instrument' => $instrument,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Instrument $instrument, InstrumentRepository $instrumentRepository): Response
    {
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $instrumentRepository->add($instrument, true);

            return $this->redirectToRoute('app_instrument_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/instrument_crud/edit.html.twig', [
            'instrument' => $instrument,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Instrument $instrument, InstrumentRepository $instrumentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instrument->getId(), $request->request->get('_token'))) {
            $instrumentRepository->remove($instrument, true);
        }

        return $this->redirectToRoute('app_instrument_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
