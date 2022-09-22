<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use App\Form\GalleryType;
use App\Repository\GalleryRepository;
use App\Service\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new(Request $request,
                        GalleryRepository $galleryRepository,
                        Slugify $slugify,
                        EntityManagerInterface $doctrine): Response
    {
        $gallery = new Gallery();

        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()->getPosters() as $poster) {
                $doctrine->persist($poster);
                $gallery->addPoster($poster);
            }
            $gallery->setSlug($slugify->generate($gallery->getTitle()));
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
    public function edit(Request $request, Gallery $gallery, GalleryRepository $galleryRepository, Slugify $slugify, EntityManagerInterface $doctrine): Response
    {
        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()->getPosters() as $poster) {
                $doctrine->persist($poster);
                $gallery->addPoster($poster);
            }
            $gallery->setSlug($slugify->generate($gallery->getTitle()));
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
