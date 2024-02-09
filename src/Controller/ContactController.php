<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $formContact = $this->createForm(ContactType::class);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) :

            $contactData = $formContact->getData();

            $email = (new Email())
                // ->from('contact@cdi.fr')
                ->to($contactData['email'])
                ->subject($contactData['sujet'])
                ->text($contactData['message'])
                ->text('<p>' . $contactData['message'] . '</p>');

            $mailer->send($email);

            return $this->redirectToRoute('app_home');

        endif;

        return $this->render('contact/index.html.twig', [
            'formContact' => $formContact
        ]);
    }
}
