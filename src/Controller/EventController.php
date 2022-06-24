<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use App\Service\JsonResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event', name: 'event_')]
class EventController extends AbstractController
{
    #[Route('/', name: 'index', methods: 'GET')]
    public function index(): Response
    {

        return $this->render('event/index.html.twig');
    }


    #[Route('/show/{id}', name: 'show', methods: 'GET')]
public function showOneEvent(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }
//    TODO: rajouter une route showAllEvent pour afficher tous les events dans le calendrier
//TODO: créer la modale pour afficher un event au click sur le calendrier avec une requéte AJAX
}
