<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\InformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, InformationsRepository $informationsRepository): Response
    {
        $address = $informationsRepository->findOneBy(['slug' => 'adresse']);
        $tel = $informationsRepository->findOneBy(['slug' => 'telephone']);
        $coordonneespro = $informationsRepository->findOneBy(['slug' => 'coordonnees_pro']);

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $emailClient = (new Email())
            ->from('pinarthur65@gmail.com');
        }
        

        $page = [ 
            'libelle' => 'Contact',
            'title' => 'Contact'
            
        ];

        return $this->render('/pages/contact/contact.html.twig', [
            'page' => $page,
            'form' => $form,
            'address' => $address,
            'tel' => $tel,
            'coorpro' => $coordonneespro
        ]);
    }
}
