<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event', name: 'event_')]
class EventController extends AbstractController
{
    #[Route('/', name: 'index', methods: 'GET')]
    public function index(EventRepository $eventRepository): Response
    {

        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findBy(['category' => 'concert'], ['start_at' => 'ASC'])
        ]);
    }

    #[Route('/show', name: 'show_all', methods: 'GET')]
    public function showAllEvents(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();
        $data = [];
        foreach ($events as $event) {
            $data[] = [
                'id' => $event->getId(),
                'title' => $event->getTitle(),
                'start' => $event->getStartAt()->format('Y-m-d H:i:s'),
                'end' => $event->getEndAt()->format('Y-m-d H:i:s'),
            ];
        }
        return new JsonResponse($data);
    }

    #[Route('/show/{id}', name: 'show', methods: 'GET')]
    public function showOneEvent(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

//TODO: créer la modale pour afficher un event au click sur le calendrier avec une requéte AJAX
}
