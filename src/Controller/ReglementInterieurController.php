<?php

namespace App\Controller;

use App\Repository\InformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReglementInterieurController extends AbstractController
{
    #[Route('/reglement/interieur', name: 'reglement_interieur')]
    public function index(InformationsRepository $informationsRepository): Response
    {
        $address = $informationsRepository->findOneBy(['slug' => 'adresse']);
        $coorpro = $informationsRepository->findOneBy(['slug' => 'coordonnees_pro']);
        $tel = $informationsRepository->findOneBy(['slug' => 'telephone']);
        $email = $informationsRepository->findOneBy(['slug' => 'email']);

        $page = 'Règlement intérieur';

        return $this->render('/pages/reglement_interieur/reglement_interieur.html.twig', [
            'page' => $page,
            'address' => $address,
            'coorpro' => $coorpro,
            'tel' => $tel,
            'email' => $email
        ]);
    }
}
