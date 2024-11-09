<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\InformationsRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, InformationsRepository $informationsRepository, MailerInterface $mailer): Response
    {
        $address = $informationsRepository->findOneBy(['slug' => 'adresse']);
        $tel = $informationsRepository->findOneBy(['slug' => 'telephone']);
        $coordonneespro = $informationsRepository->findOneBy(['slug' => 'coordonnees_pro']);
        $error = '';

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $emailClient = (new TemplatedEmail())
            ->from('pinarthur65@gmail.com')
            ->to($data['email'])
            ->subject('Camping Plage du midi - Confirmation de contact')
            ->htmlTemplate('emails/confirmationContact.html.twig')
            ->context([
                'name' => $data['name'],
                'firstName' => $data['firstName'],
                'subject' => $data['subject'],
                'message' => $data['message']
            ]);

            $email = (new TemplatedEmail())
            ->from('pinarthur65@gmail.com')
            ->to($data['email'])
            ->subject('Camping Plage du midi - Demande de contact')
            ->htmlTemplate('emails/demandeContact.html.twig')
            ->context([
                'name' => $data['name'],
                'firstName' => $data['firstName'],
                'emailUser' => $data['email'],
                'subject' => $data['subject'],
                'message' => $data['message']
            ]);

            try{

                $mailer->send($emailClient);
                $mailer->send($email);

            }catch(TransportExceptionInterface $e){
                $error = 'Nous rencontrons un problème lors de l\'envoi du mail. Merci de réessayer plus tard.';
            }

            return $this->redirectToRoute('contact');
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
            'coorpro' => $coordonneespro,
            'error' => $error
        ]);
    }
}
