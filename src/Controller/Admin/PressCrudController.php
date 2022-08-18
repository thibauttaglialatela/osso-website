<?php

namespace App\Controller\Admin;

use App\Entity\Press;
use App\Form\PressType;
use App\Repository\PressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/press/crud', name: 'app_press_crud_')]
class PressCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PressRepository $pressRepository): Response
    {
        return $this->render('/admin/press_crud/index.html.twig', [
            'presses' => $pressRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, PressRepository $pressRepository): Response
    {
        $press = new Press();
        $form = $this->createForm(PressType::class, $press);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pressRepository->add($press, true);

            return $this->redirectToRoute('app_press_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/admin/press_crud/new.html.twig', [
            'press' => $press,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Press $press): Response
    {
        return $this->render('/admin/press_crud/show.html.twig', [
            'press' => $press,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Press $press, PressRepository $pressRepository): Response
    {
        $form = $this->createForm(PressType::class, $press);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pressRepository->add($press, true);

            return $this->redirectToRoute('app_press_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/press_crud/edit.html.twig', [
            'press' => $press,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Press $press, PressRepository $pressRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$press->getId(), $request->request->get('_token'))) {
            $pressRepository->remove($press, true);
        }

        return $this->redirectToRoute('app_press_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
