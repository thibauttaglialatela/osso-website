<?php

namespace App\Controller\Admin;

use App\Entity\Compositor;
use App\Form\CompositorType;
use App\Repository\CompositorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/compositor/crud', name: 'app_compositor_crud_')]
class CompositorCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CompositorRepository $compositorRepository): Response
    {
        return $this->render('admin/compositor_crud/index.html.twig', [
            'compositors' => $compositorRepository->findBy([], ['name' => 'ASC']),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompositorRepository $compositorRepository): Response
    {
        $compositor = new Compositor();
        $form = $this->createForm(CompositorType::class, $compositor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compositorRepository->add($compositor, true);

            return $this->redirectToRoute('app_compositor_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/compositor_crud/new.html.twig', [
            'compositor' => $compositor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Compositor $compositor): Response
    {
        return $this->render('admin/compositor_crud/show.html.twig', [
            'compositor' => $compositor,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Compositor $compositor, CompositorRepository $compositorRepository): Response
    {
        $form = $this->createForm(CompositorType::class, $compositor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compositorRepository->add($compositor, true);

            return $this->redirectToRoute('app_compositor_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/compositor_crud/edit.html.twig', [
            'compositor' => $compositor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Compositor $compositor, CompositorRepository $compositorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compositor->getId(), $request->request->get('_token'))) {
            $compositorRepository->remove($compositor, true);
        }

        return $this->redirectToRoute('app_compositor_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
