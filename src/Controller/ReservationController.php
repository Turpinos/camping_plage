<?php

namespace App\Controller;

use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;


class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index(MailerInterface $mailer, Request $request): Response
    {

        $form = $this->createForm(ReservationType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
           //dd($data);
        
        
            $contact = $form->getData();

            $email = (new Email())
                ->from('arthur58230@hotmail.fr')
                ->to('pinarthur65@gmail.com')
                ->subject('Test')
                ->html($data['name']);

            $mailer->send($email);

        }

        

        $page = [ 
            'libelle' => 'devis_&_reservation',
            'title' => 'Devis & Réservation'
        ];

        return $this->render('pages/reservation/reservation.html.twig', [
            'controller_name' => 'ReservationController',
            'page' => $page,
            'form' => $form
        ]);
    }
}
