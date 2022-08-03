<?php

namespace App\Controller\Admin;

use App\Entity\Musician;
use App\Form\MusicianType;
use App\Repository\MusicianRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/musician/crud', name: 'app_musician_crud_')]
class MusicianCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(MusicianRepository $musicianRepository): Response
    {
        return $this->render('/admin/musician_crud/index.html.twig', [
            'musicians' => $musicianRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, MusicianRepository $musicianRepository): Response
    {
        $musician = new Musician();
        $form = $this->createForm(MusicianType::class, $musician);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $musicianRepository->add($musician, true);

            return $this->redirectToRoute('app_musician_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/musician_crud/new.html.twig', [
            'musician' => $musician,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Musician $musician): Response
    {
        return $this->render('/admin/musician_crud/show.html.twig', [
            'musician' => $musician,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Musician $musician, MusicianRepository $musicianRepository): Response
    {
        $form = $this->createForm(MusicianType::class, $musician);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $musicianRepository->add($musician, true);

            return $this->redirectToRoute('app_musician_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/musician_crud/edit.html.twig', [
            'musician' => $musician,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Musician $musician, MusicianRepository $musicianRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$musician->getId(), $request->request->get('_token'))) {
            $musicianRepository->remove($musician, true);
        }

        return $this->redirectToRoute('app_musician_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
