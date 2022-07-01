<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/contact', name: 'contact_')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, ContactRepository $contactRepository, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->add($contact, true);
            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('osso64@test.com')
                ->cc('cc@example.com')
                ->subject($contact->getSubject())
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'contact' => $contact
                ]);

            $mailer->send($email);
            $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('contact_index');
        }
        return $this->renderForm('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
