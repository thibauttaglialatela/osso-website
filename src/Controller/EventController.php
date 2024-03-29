<?php

namespace App\Controller;

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
        $currentDate = new \DateTime();
        $currentDate->format('Y-m-d H:i:s');
        $oldEvents = $eventRepository->getOldEvent($currentDate);
        $newEvents = $eventRepository->getNewEvent($currentDate);

        return $this->render('event/index.html.twig', [
            'old_events' => $oldEvents,
            'new_events' => $newEvents,
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
    public function showOneEvent(int $id, EventRepository $eventRepository): JsonResponse
    {
        $event = $eventRepository->find($id);
        $eventModal = [
            'id' => $event->getId(),
            'title' => $event->getTitle(),
            'body' => $event->getBody(),
        ];

        return $this->json($eventModal);
    }
}
