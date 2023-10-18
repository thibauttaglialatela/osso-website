<?php

namespace App\Controller;

use App\Repository\GalleryRepository;
use App\Repository\PosterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallery', name: 'gallery_')]
class GalleryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(GalleryRepository $galleryRepository): Response
    {
        $galleries = $galleryRepository->findAll();

        return $this->render('gallery/index.html.twig', [
            'galleries' => $galleries,
        ]);
    }

    #[Route('/{gallerySlug}', name: 'show')]
    public function show(string $gallerySlug, GalleryRepository $galleryRepository, PosterRepository $posterRepository): Response
    {
        $gallery = $galleryRepository->findOneBy(['slug' => $gallerySlug]);
        if (!$gallery) {
            throw $this->createNotFoundException('aucune galerie trouvé');
        } else {
            $posters = $posterRepository->findBy(['gallery' => $gallery]);
        }


        return $this->render('gallery/show.html.twig', [
            'posters' => $posters,
        ]);
    }
}
