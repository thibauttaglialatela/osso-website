<?php

namespace App\Controller;

use App\Repository\ContenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/orchestra/', name: 'orchestra_')]
class OrchestraController extends AbstractController
{
    #[Route('presentation/', name: 'presentation')]
    public function index(ContenuRepository $contenuRepository): Response
    {
        //récupérer les données de la table contenu pour les afficher dans notre vue
        $ossoHistory = $contenuRepository->findBy(['identifier' => 'orchestra-history']);
        $directorBiography = $contenuRepository->findBy(['identifier' => 'director-biography']);
        $administrationCouncil = $contenuRepository->findBy(['identifier' => 'conseil administration']);

        return $this->render('orchestra_presentation/index.html.twig', [
            'osso_history' => $ossoHistory,
            'director_biography' => $directorBiography,
            'administration_council' => $administrationCouncil
        ]);
    }
}
