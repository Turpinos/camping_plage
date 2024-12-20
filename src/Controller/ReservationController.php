<?php

namespace App\Controller;

use App\Form\ReservationType;
use App\Repository\LocatifsRepository;
use App\Repository\TypeLocatifsRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;


class ReservationController extends AbstractController
{
    #[Route('/reservation/{slug}', name: 'reservation')]
    public function index(MailerInterface $mailer, Request $request, LocatifsRepository $locatifRepository, TypeLocatifsRepository $typeLocatifsRepository, string $slug = null): Response
    {
        //Vérification de la validité du slug
        $compSlug = $locatifRepository->findAll();
        $testValue = false;

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $url = '';
        $urlContact = $protocol . $host . '/contact';
        $locatif = [];
        $typeLocatif = ['id' => 0];
        $error = '';

        //comparaison du slug donné aux slugs existant
        foreach ($compSlug as $comp) {
            if($comp->getSlug() == $slug){
                $testValue = true;
            }
        }

        if(!$testValue){
            $slug = null;
        }

        $form = $this->createForm(ReservationType::class);

        if($slug != null){

            //Récupération info locatifs..
            $locatif = $locatifRepository->findOneBy(['slug' => $slug]);
            $typeLocatif = $typeLocatifsRepository->findOneBy(['id' => $locatif->getIdTypeLocatifs()]);

            //Création auto url..
            $url = $protocol . $host . '/locatifs_details/' . $slug;
        }

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $voyageurs = [];
            $ageData = json_decode($data['hiddenInputAge']);
            $i = 0;
            do {

                if($ageData[$i] == 1){
                    $voyageurs['Voyageur '.$i+1 ] = '0-3 ans';
                    
                }elseif($ageData[$i] == 2){
                    $voyageurs['Voyageur '.$i+1] = '4-10 ans';

                }elseif($ageData[$i] == 3){
                    $voyageurs['Voyageur '.$i+1] = '11-17 ans';
                         
                }elseif($ageData[$i] == 4){
                    $voyageurs['Voyageur '.$i+1] = '18-28 ans';

                }elseif($ageData[$i] == 5){
                    $voyageurs['Voyageur '.$i+1] = '+28 ans';

                }

                $i++;
            } while ($i < count($ageData));

            $emailClient = (new TemplatedEmail())
                ->from('arthur58230@hotmail.fr')
                ->to($data['email'])
                ->subject('Camping Plage du midi - Confirmation de contact')
                ->htmlTemplate('emails/confirmationResa.html.twig')
                ->context([
                    'name' => $data['name'],
                    'firstName' => $data['firstName'],
                    'address' => $data['address'],
                    'phone' => $data['phone'],
                    'nbrAnimaux' => $data['nombreAnimaux'],
                    'ageVoyageurs' => $voyageurs,
                    'chalet' => $data['chalet'],
                    'chaletGite' => $data['chaletGite'],
                    'cabane' => $data['cabane'],
                    'roulotte' => $data['roulotte'],
                    'campingCar' => $data['campingCar'],
                    'caravane' => $data['caravane'],
                    'tente' => $data['tente'],
                    'electricite' => $data['electricite'],
                    'dateDebut' => $data['debutDuSejour'],
                    'dateFin' => $data['finDuSejour'],
                    'nbrVehicule' => $data['nombreVehicules'],
                    'commentaire' => $data['commentaire'],
                    'locatif' => $locatif,
                    'typeLocatif' => $typeLocatif,
                    'url' => $url,
                    'urlContact' => $urlContact

                ]);

                $email = (new TemplatedEmail())
                ->from('arthur58230@hotmail.fr')
                ->to('arthur58230@hotmail.fr')
                ->subject('Camping Plage du midi - Demande de devis/réservation')
                ->htmlTemplate('emails/demandeResa.html.twig')
                ->context([
                    'name' => $data['name'],
                    'firstName' => $data['firstName'],
                    'emailUser' => $data['email'],
                    'address' => $data['address'],
                    'phone' => $data['phone'],
                    'nbrAnimaux' => $data['nombreAnimaux'],
                    'ageVoyageurs' => $voyageurs,
                    'chalet' => $data['chalet'],
                    'chaletGite' => $data['chaletGite'],
                    'cabane' => $data['cabane'],
                    'roulotte' => $data['roulotte'],
                    'campingCar' => $data['campingCar'],
                    'caravane' => $data['caravane'],
                    'tente' => $data['tente'],
                    'electricite' => $data['electricite'],
                    'dateDebut' => $data['debutDuSejour'],
                    'dateFin' => $data['finDuSejour'],
                    'nbrVehicule' => $data['nombreVehicules'],
                    'commentaire' => $data['commentaire'],
                    'locatif' => $locatif,
                    'typeLocatif' => $typeLocatif

                ]);

                try {

                    $mailer->send($emailClient);
                    $mailer->send($email);

                } catch (TransportExceptionInterface $e) {

                    $error = 'Nous rencontrons un problème lors de l\'envoi du mail. Merci de réessayer plus tard.';
                    
                }
            

            return $this->redirectToRoute('reservation');

        }

        

        $page = 'Devis & Réservation';

        return $this->render('pages/reservation/reservation.html.twig', [
            'controller_name' => 'ReservationController',
            'page' => $page,
            'form' => $form,
            'locatif' => $locatif,
            'typeLocatif' => $typeLocatif,
            'error' => $error
        ]);
    }
}
