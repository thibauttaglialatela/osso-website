<?php

namespace App\Controller\Admin;

use App\Entity\MusicalWork;
use App\Form\MusicalWorkType;
use App\Repository\MusicalWorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/musical/work/crud', name: 'app_musical_work_crud_')]
class MusicalWorkCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(MusicalWorkRepository $musicalWorkRepository): Response
    {
        return $this->render('/admin/musical_work_crud/index.html.twig', [
            'musical_works' => $musicalWorkRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, MusicalWorkRepository $musicalWorkRepository): Response
    {
        $musicalWork = new MusicalWork();
        $form = $this->createForm(MusicalWorkType::class, $musicalWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $musicalWorkRepository->add($musicalWork, true);

            return $this->redirectToRoute('app_musical_work_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/musical_work_crud/new.html.twig', [
            'musical_work' => $musicalWork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(MusicalWork $musicalWork): Response
    {
        return $this->render('/admin/musical_work_crud/show.html.twig', [
            'musical_work' => $musicalWork,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MusicalWork $musicalWork, MusicalWorkRepository $musicalWorkRepository): Response
    {
        $form = $this->createForm(MusicalWorkType::class, $musicalWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $musicalWorkRepository->add($musicalWork, true);

            return $this->redirectToRoute('app_musical_work_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/musical_work_crud/edit.html.twig', [
            'musical_work' => $musicalWork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, MusicalWork $musicalWork, MusicalWorkRepository $musicalWorkRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$musicalWork->getId(), $request->request->get('_token'))) {
            $musicalWorkRepository->remove($musicalWork, true);
        }

        return $this->redirectToRoute('app_musical_work_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
