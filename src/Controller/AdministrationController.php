<?php

namespace App\Controller;

use App\Entity\AccesPmr;
use App\Entity\Gallery;
use App\Entity\Informations;
use App\Entity\Ouvertures;
use App\Entity\Saisons;
use App\Entity\TarifsGlobaux;
use App\Form\AccesPmrType;
use App\Form\DeleteAccesPmrType;
use App\Form\DeleteGalleryType;
use App\Form\GalleryType;
use App\Form\InformationsType;
use App\Form\OuverturesType;
use App\Form\SaisonsType;
use App\Form\TarifsGlobauxType;
use App\Repository\AccesPmrRepository;
use App\Repository\CoordonneesMapRepository;
use App\Repository\GalleryRepository;
use App\Repository\ImagesRepository;
use App\Repository\InformationsRepository;
use App\Repository\LocatifsRepository;
use App\Repository\OuverturesRepository;
use App\Repository\SaisonsRepository;
use App\Repository\TarifsGlobauxRepository;
use App\Service\PictureService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AdministrationController extends AbstractController
{
    #[Route('/administration', name: 'app_administration')]
    public function index(LocatifsRepository $locatifsRepository, ImagesRepository $imagesRepository, CoordonneesMapRepository $coordonneesMapRepository, SaisonsRepository $saisonsRepository, OuverturesRepository $ouverturesRepository, GalleryRepository $galleryRepository, InformationsRepository $informationsRepository, TarifsGlobauxRepository $tarifsGlobauxRepository, AccesPmrRepository $accesPmrRepository, EntityManagerInterface $entityManager, FormFactoryInterface $formFactory, PictureService $pictureService, Request $request): Response
    {

        $locatifs = $locatifsRepository->findAll();
        $images = $imagesRepository->findAll();
        $emplacements = $coordonneesMapRepository->findAll();
        $saisons = $saisonsRepository->findAll();
        $ouvertures = $ouverturesRepository->findAll();
        $gallery = $galleryRepository->findAll();
        $informations = $informationsRepository->findAll();
        $tarifs = $tarifsGlobauxRepository->findAll();
        $accesPmr = $accesPmrRepository->findAll();

        //appel form avec nom perso pour éviter conflit de validation..
        $formSaisons = $formFactory->createNamed('form_saisons', SaisonsType::class);
        $formOuvertures = $formFactory->createNamed('form_ouvertures', OuverturesType::class);
        $formGallery = $formFactory->createNamed('form_gallery', GalleryType::class);
        $formInfo = $formFactory->createNamed('form_informations', InformationsType::class);
        $formTarifs = $formFactory->createNamed('form_tarifs', TarifsGlobauxType::class);
        $formAccesPmr = $formFactory->createNamed('form_AccesPmr', AccesPmrType::class);
        $formDelGallery = $formFactory->createNamed('form_DelGallery', DeleteGalleryType::class);
        $formDelAccesPmr = $formFactory->createNamed('form_DelAccesPmr', DeleteAccesPmrType::class);


        //Vérification des formulaires pour l'update..
        $formSaisons->handleRequest($request);
        if ($formSaisons->isSubmitted() && $formSaisons->isValid()) {

            $data = $formSaisons->getData();

            $updateSaison = $entityManager->getRepository(Saisons::class)->find($data['id']);

            if($updateSaison->getLibelle() != $data['libelle']){

                $updateSaison->setLibelle($data['libelle']);
                $slugger = new AsciiSlugger();
                $updateSaison->setSlug($slugger->slug($data['libelle']));

            }

            $dateDebut = date_format($data['date_debut'], 'Y-m-d');
            $dateDebut = new DateTimeImmutable($dateDebut);

            if($updateSaison->getDateDebut() != $dateDebut){
                $updateSaison->setDateDebut($dateDebut);
            }

            $dateFin = date_format($data['date_fin'], 'Y-m-d');
            $dateFin = new DateTimeImmutable($dateFin);
            
            if($updateSaison->getDateFin() != $dateFin){
                $updateSaison->setDateFin($dateDebut);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_administration');
            
        }

        $formOuvertures->handleRequest($request);
        if($formOuvertures->isSubmitted() && $formOuvertures->isValid()){

            $data = $formOuvertures->getData();
            
            $updateOuverture = $entityManager->getRepository(Ouvertures::class)->find($data['id']);

            if($updateOuverture->getLibelle() != $data['libelle']){
                $updateOuverture->setLibelle($data['libelle']);
                $slugger = new AsciiSlugger();
                $updateOuverture->setSlug($slugger->slug($data['libelle']));
            }

            if($data['choice_type'] == 'true'){

                $updateOuverture->setActif(true);

            }else if($data['choice_type'] == 'false'){

                $updateOuverture->setActif(false);

            }else if($data['choice_type'] == 'null'){

                $updateOuverture->setActif(null);

            }

            $entityManager->flush();

            return $this->redirectToRoute('app_administration');

        }

        $formGallery->handleRequest($request);
        if($formGallery->isSubmitted() && $formGallery->isValid()){
            
            $data = $formGallery->getData();

            $infoImg = $pictureService->freeresize($data['img_url'], '../public/images/media/');

            if($infoImg != 'erreur'){

                $addgallery = new Gallery;
                $addgallery->setImgUrl($infoImg);
                $addgallery->setImgAlt(str_replace('.jpg', '', $infoImg));

                $entityManager->persist($addgallery);
                $entityManager->flush();

                return $this->redirectToRoute('app_administration');

            }


        }

        $formDelGallery->handleRequest($request);
        if($formDelGallery->isSubmitted() && $formDelGallery->isValid()){

            $data = $formDelGallery->getData();
            $removegallery = $entityManager->getRepository(Gallery::class)->find($data['id']);

            //suppressions du dossier..
            unlink('../public/images/media/' . $removegallery->getImgUrl());
            
            $entityManager->remove($removegallery);
            $entityManager->flush();

            return $this->redirectToRoute('app_administration');
        }

        $formInfo->handleRequest($request);
        if($formInfo->isSubmitted() && $formInfo->isValid()){

            $data = $formInfo->getData();
            $updateInfo = $entityManager->getRepository(Informations::class)->find($data['id']);

            if($updateInfo->getLibelle() != $data['libelle']){

                $updateInfo->setLibelle($data['libelle']);
                $slugger = new AsciiSlugger();
                $updateInfo->setSlug($slugger->slug($data['libelle']));

            }

            if($updateInfo->getContenu() != $data['contenu']){
                $updateInfo->setContenu($data['contenu']);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_administration');
        }

        $formTarifs->handleRequest($request);
        if($formTarifs->isSubmitted() && $formTarifs->isValid()){

            $data = $formTarifs->getData();
            $updateTarifs = $entityManager->getRepository(TarifsGlobaux::class)->find($data['id']);

            if($updateTarifs->getLibelle() != $data['libelle']){

                $updateTarifs->setLibelle($data['libelle']);
                $slugger = new AsciiSlugger();
                $updateTarifs->setSlug($slugger->slug($data['libelle']));

            }

            if($updateTarifs->getValeur() != $data['valeur']){
                $updateTarifs->setValeur($data['valeur']);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_administration');
        }

        $formAccesPmr->handleRequest($request);
        if($formAccesPmr->isSubmitted() && $formAccesPmr->isValid()){

            $data = $formAccesPmr->getData();
            
            if($data['id'] != '0' && $data['id'] != null){

                $updateAccesPmr = $entityManager->getRepository(AccesPmr::class)->find($data['id']);

                if($updateAccesPmr->getLibelle() != $data['libelle']){

                    $updateAccesPmr->setLibelle($data['libelle']);
                    $slugger = new AsciiSlugger();
                    $updateAccesPmr->setSlug($slugger->slug($data['libelle']));

                }

                $entityManager->flush();

            }else if($data['id'] == '0'){

                $addAccesPmr = new AccesPmr();

                $addAccesPmr->setLibelle($data['libelle']);
                $slugger = new AsciiSlugger();
                $addAccesPmr->setSlug($slugger->slug($data['libelle']));

                $entityManager->persist($addAccesPmr);
                $entityManager->flush();

            }

            return $this->redirectToRoute('app_administration');
        }

        $formDelAccesPmr->handleRequest($request);
        if($formDelAccesPmr->isSubmitted() && $formDelAccesPmr->isValid()){
            
            $data = $formDelAccesPmr->getData();
            $delAccesPmr = $entityManager->getRepository(AccesPmr::class)->find($data['id']);
            $entityManager->remove($delAccesPmr);
            $entityManager->flush();

            return $this->redirectToRoute('app_administration');
        }

        return $this->render('pages/administration/admin.html.twig', [
            'locatifs' => $locatifs,
            'images' => $images,
            'emplacements' => $emplacements,
            'saisons' => $saisons,
            'ouvertures' => $ouvertures,
            'gallery' => $gallery,
            'informations' => $informations,
            'tarifs' => $tarifs,
            'accesPmr' => $accesPmr,
            'formSaisons' => $formSaisons,
            'formOuvertures' => $formOuvertures,
            'formGallery' => $formGallery,
            'formInfo' => $formInfo,
            'formTarifs' => $formTarifs,
            'formAccesPmr' => $formAccesPmr,
            'formDelGallery' => $formDelGallery,
            'formDelAccesPmr' => $formDelAccesPmr

        ]);
    }
}
