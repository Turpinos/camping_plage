<?php

namespace App\Controller;

use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index(): Response
    {

        $form = $this->createForm(ReservationType::class);

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
