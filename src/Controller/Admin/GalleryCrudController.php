<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use App\Form\GalleryType;
use App\Repository\GalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[Route('admin/gallery/crud', name: 'app_gallery_crud_')]
class GalleryCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(GalleryRepository $galleryRepository): Response
    {
        return $this->render('admin/gallery_crud/index.html.twig', [
            'galleries' => $galleryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, GalleryRepository $galleryRepository, AsciiSlugger $slugger): Response
    {
        $gallery = new Gallery();
        $gallery->setSlug($slugger->slug($gallery->getTitle()));
        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $galleryRepository->add($gallery, true);

            return $this->redirectToRoute('app_gallery_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/gallery_crud/new.html.twig', [
            'gallery' => $gallery,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Gallery $gallery): Response
    {
        return $this->render('admin/gallery_crud/show.html.twig', [
            'gallery' => $gallery,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gallery $gallery, GalleryRepository $galleryRepository): Response
    {
        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $galleryRepository->add($gallery, true);

            return $this->redirectToRoute('app_gallery_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/gallery_crud/edit.html.twig', [
            'gallery' => $gallery,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Gallery $gallery, GalleryRepository $galleryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gallery->getId(), $request->request->get('_token'))) {
            $galleryRepository->remove($gallery, true);
        }

        return $this->redirectToRoute('app_gallery_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
