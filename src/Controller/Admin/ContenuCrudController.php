<?php

namespace App\Controller\Admin;

use App\Entity\Contenu;
use App\Form\ContenuType;
use App\Repository\ContenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/contenu/crud', name:'app_contenu_crud_')]
class ContenuCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ContenuRepository $contenuRepository): Response
    {
        return $this->render('admin/contenu_crud/index.html.twig', [
            'contenus' => $contenuRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContenuRepository $contenuRepository): Response
    {
        $contenu = new Contenu();
        $form = $this->createForm(ContenuType::class, $contenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contenuRepository->save($contenu, true);

            return $this->redirectToRoute('app_contenu_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/contenu_crud/new.html.twig', [
            'contenu' => $contenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Contenu $contenu): Response
    {
        return $this->render('admin/contenu_crud/show.html.twig', [
            'contenu' => $contenu,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contenu $contenu, ContenuRepository $contenuRepository): Response
    {
        $form = $this->createForm(ContenuType::class, $contenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contenuRepository->save($contenu, true);

            return $this->redirectToRoute('app_contenu_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/contenu_crud/edit.html.twig', [
            'contenu' => $contenu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Contenu $contenu, ContenuRepository $contenuRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contenu->getId(), $request->request->get('_token'))) {
            $contenuRepository->remove($contenu, true);
        }

        return $this->redirectToRoute('app_contenu_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
