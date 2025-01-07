<?php

namespace App\Controller;

use App\Entity\CoordonneesMap;
use App\Entity\Images;
use App\Entity\Inventaire;
use App\Entity\Locatifs;
use App\Entity\Tarifs;
use App\Form\CoordonneeType;
use App\Form\DeleteType;
use App\Form\GalleryType;
use App\Form\InventaireType;
use App\Form\LocatifType;
use App\Form\TarifsCabaneType;
use App\Form\TarifsCampingType;
use App\Form\TarifsChaletType;
use App\Repository\LocatifsRepository;
use App\Service\FileService;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AdministrationLocatifController extends AbstractController
{
    #[Route('/administration/locatif/{slug}', name: 'app_administration_locatif')]
    public function index(LocatifsRepository $locatifsRepository, PictureService $picture, FileService $file, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, Request $request, string $slug = null): Response
    {

        //Test de la validité du slug avant gestion du controller..
        $listSlug = $locatifsRepository->findAll();
        $validSlug = false;

        foreach ($listSlug as $locatif) {
            if($locatif->getSlug() == $slug){
                $validSlug = true;
            }
        }

        if(!$validSlug){

            return $this->redirectToRoute('app_administration');

        }


        //Récuperation des infos..
        $locatif = $locatifsRepository->findOneBy(['slug' => $slug]);
        $coordonneesMap = $locatif->getCoordonneesMaps();
        $images = $locatif->getImages();
        $inventaire = $locatif->getInventaires();
        $tarifs = $locatif->getIdTarifs();

        $formLocatifs = $formFactory->createNamed('form_locatifs', LocatifType::class);
        $formImages = $formFactory->createNamed('form_images', GalleryType::class);
        $formDelImages = $formFactory->createNamed('form_delImages', DeleteType::class);
        $formVignettes = $formFactory->createNamed('form_vignette', GalleryType::class);
        $formInventaire = $formFactory->createNamed('form_inventaire', InventaireType::class);
        $formDelInventaire = $formFactory->createNamed('form_delInventaire', DeleteType::class);
        $formCoordonnees = $formFactory->createNamed('form_coordonnees', CoordonneeType::class);
        $formTarifs = [];

        if($locatif->getId() == 10){
            $formTarifs = $formFactory->createNamed('form_tarifs', TarifsCabaneType::class);
        }else if($locatif->getId() == 11){
            $formTarifs = $formFactory->createNamed('form_tarifs', TarifsCampingType::class);
        }else{
            $formTarifs = $formFactory->createNamed('form_tarifs', TarifsChaletType::class);
        }

        $isPmr = [];
        if($locatif->isPmr() == "1"){
            $isPmr[] = $locatif->getId();
        }

        $formLocatifs->handleRequest($request);
        if($formLocatifs->isSubmitted() && $formLocatifs->isValid()){
            $data = $formLocatifs->getData();

            $updateLocatifs = $entityManager->getRepository(Locatifs::class)->find($data['id']);

            if($updateLocatifs->getLibelle() != $data['libelle']){
                $updateLocatifs->setLibelle($data['libelle']);
                $slugger = new AsciiSlugger();
                $updateLocatifs->setSlug($slugger->slug($data['libelle']));
            }

            if($updateLocatifs->getDescription() != $data['description']){
                $updateLocatifs->setDescription($data['description']);
            }

            if($updateLocatifs->getCapacite() != $data['capacite']){
                $updateLocatifs->setCapacite($data['capacite']);
            }

            if($updateLocatifs->getSuperficie() != $data['superficie']){
                $updateLocatifs->setSuperficie($data['superficie']);
            }

            if($data['pmr_type'] == 'true'){
                $updateLocatifs->setPmr(true);
            }else if($data['pmr_type'] == 'false'){
                $updateLocatifs->setPmr(false);
            }

            if($data['hiver_type'] == 'true'){
                $updateLocatifs->setOuvertureHivernale(true);
            }else if($data['hiver_type'] == 'false'){
                $updateLocatifs->setOuvertureHivernale(false);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_administration_locatif', ['slug' => $locatif->getSlug()]);
        }

        $formTarifs->handleRequest($request);
        if($formTarifs->isSubmitted() && $formTarifs->isValid()){
            $data = $formTarifs->getData();
            
            $updateTarifs = $entityManager->getRepository(Tarifs::class)->find($data['id']);

            if($locatif->getId() == 10){

                if($updateTarifs->getCaution() != $data['caution']){
                    $updateTarifs->setCaution($data['caution']);
                }

                if($updateTarifs->getArrhesNuitee() != $data['arrhes_jour']) {
                    $updateTarifs->setArrhesNuitee($data['arrhes_jour']);
                }

                if($updateTarifs->getArrhesSemaine() != $data['arrhes_semaine']){
                    $updateTarifs->setArrhesSemaine($data['arrhes_semaine']);
                }

                if($updateTarifs->getBsNuitee2() != $data['bs_nuitee_2']){
                    $updateTarifs->setBsNuitee2($data['bs_nuitee_2']);
                }

                if($updateTarifs->getBsNuitee3() != $data['bs_nuitee_3']){
                    $updateTarifs->setBsNuitee3($data['bs_nuitee_3']);
                }

                if($updateTarifs->getBsNuitee4() != $data['bs_nuitee_4']){
                    $updateTarifs->setBsNuitee4($data['bs_nuitee_4']);
                }

                if($updateTarifs->getHsNuitee2() != $data['hs_nuitee_2']){
                    $updateTarifs->setHsNuitee2($data['hs_nuitee_2']);
                }

                if($updateTarifs->getHsNuitee3() != $data['hs_nuitee_3']){
                    $updateTarifs->setHsNuitee3($data['hs_nuitee_3']);
                }

                if($updateTarifs->getHsNuitee4() != $data['hs_nuitee_4']){
                    $updateTarifs->setHsNuitee4($data['hs_nuitee_4']);
                }

                if($updateTarifs->getTvJour() != $data['tv_jour']){
                    $updateTarifs->setTvJour($data['tv_jour']);
                }
                
                if($updateTarifs->getTvSemaine() != $data['tv_semaine']){
                    $updateTarifs->setTvSemaine($data['tv_semaine']);
                }

                if($updateTarifs->getAnimaux() != $data['animaux']){
                    $updateTarifs->setAnimaux($data['animaux']);
                }

                if($data['choice_type'] == 'true'){
                    $updateTarifs->setDejInclu(true);
                }else if($data['choice_type'] == 'false'){
                    $updateTarifs->setDejInclu(false);
                }

            }else if($locatif->getId() == 11){

                if($updateTarifs->getArrhesNuitee() != $data['arrhes_jour']) {
                    $updateTarifs->setArrhesNuitee($data['arrhes_jour']);
                }

                if($updateTarifs->getArrhesSemaine() != $data['arrhes_semaine']){
                    $updateTarifs->setArrhesSemaine($data['arrhes_semaine']);
                }

                if($updateTarifs->getAnimaux() != $data['animaux']){
                    $updateTarifs->setAnimaux($data['animaux']);
                }

                if($data['choice_type'] == 'true'){
                    $updateTarifs->setDejInclu(true);
                }else if($data['choice_type'] == 'false'){
                    $updateTarifs->setDejInclu(false);
                }

            }else{

                if($updateTarifs->getHsSemaine() != $data['hs_semaine']){
                    $updateTarifs->setHsSemaine($data['hs_semaine']);
                }

                if($updateTarifs->getBsNuitee() != $data['bs_nuitee']){
                    $updateTarifs->setBsNuitee($data['bs_nuitee']);
                }

                if($updateTarifs->getBsSemaine() != $data['bs_semaine']){
                    $updateTarifs->setBsSemaine($data['bs_semaine']);
                }

                if($updateTarifs->getHvNuitee() != $data['hv_nuitee']){
                    $updateTarifs->setHvNuitee($data['hv_nuitee']);
                }

                if($updateTarifs->getHvSemaine() != $data['hv_semaine']){
                    $updateTarifs->setHvSemaine($data['hv_semaine']);
                }

                if($updateTarifs->getCaution() != $data['caution']){
                    $updateTarifs->setCaution($data['caution']);
                }

                if($updateTarifs->getArrhesNuitee() != $data['arrhes_jour']) {
                    $updateTarifs->setArrhesNuitee($data['arrhes_jour']);
                }

                if($updateTarifs->getArrhesSemaine() != $data['arrhes_semaine']){
                    $updateTarifs->setArrhesSemaine($data['arrhes_semaine']);
                }

                if($updateTarifs->getTvJour() != $data['tv_jour']){
                    $updateTarifs->setTvJour($data['tv_jour']);
                }
                
                if($updateTarifs->getTvSemaine() != $data['tv_semaine']){
                    $updateTarifs->setTvSemaine($data['tv_semaine']);
                }

                if($updateTarifs->getAnimaux() != $data['animaux']){
                    $updateTarifs->setAnimaux($data['animaux']);
                }

                if($data['choice_type'] == 'true'){
                    $updateTarifs->setDejInclu(true);
                }else if($data['choice_type'] == 'false'){
                    $updateTarifs->setDejInclu(false);
                }

            }

            $entityManager->flush();

            return $this->redirectToRoute('app_administration_locatif', ['slug' => $locatif->getSlug()]);
        }

        $formImages->handleRequest($request);
        if($formImages->isSubmitted() && $formImages->isValid()){
            $data = $formImages->getData();

            $addImages = new Images;
            $addImages->setImgUrl($picture->freeresize($data['img_url'], '../public/images/locations/'));
            $addImages->setIsPicture(false);

            $locatif->addImage($addImages);

            $entityManager->persist($addImages);
            $entityManager->persist($locatif);
            $entityManager->flush();

            return $this->redirectToRoute('app_administration_locatif', ['slug' => $locatif->getSlug()]);
        }

        $formDelImages->handleRequest($request);
        if($formDelImages->isSubmitted() && $formDelImages->isValid()){
            $data = $formDelImages->getData();

            $removeImages = $entityManager->getRepository(Images::class)->find($data['id']);

            unlink('../public/images/locations/' . $removeImages->getImgUrl());

            $entityManager->remove($removeImages);
            $entityManager->flush();

            return $this->redirectToRoute('app_administration_locatif', ['slug' => $locatif->getSlug()]);
        }

        $formVignettes->handleRequest($request);
        if($formVignettes->isSubmitted() && $formVignettes->isValid()){
            $data = $formVignettes->getData();

            if($data['id'] == 0){
                
                $addVignette = new Images;
                $addVignette->setImgUrl($picture->squaresize($data['img_url'], '../public/images/locations/'));
                $addVignette->setIsPicture(true);

                $locatif->addImage($addVignette);

                $entityManager->persist($addVignette);
                $entityManager->persist($locatif);
                $entityManager->flush();

            }else{

                $updateVignette = $entityManager->getRepository(Images::class)->find($data['id']);

                unlink('../public/images/locations/' . $updateVignette->getImgUrl());
                $updateVignette->setImgUrl($picture->squaresize($data['img_url'], '../public/images/locations/'));

                $entityManager->flush();
                
            }

            return $this->redirectToRoute('app_administration_locatif', ['slug' => $locatif->getSlug()]);
        }

        $formInventaire->handleRequest($request);
        if($formInventaire->isSubmitted() && $formInventaire->isValid()){
            $data = $formInventaire->getData();

            $addInventaire = new Inventaire;
            $addInventaire->setPdfUrl($file->uploadPdf($data['pdf_url'], '../public/pdf/inventaires/'));

            $locatif->addInventaire($addInventaire);

            $entityManager->persist($addInventaire);
            $entityManager->persist($locatif);
            $entityManager->flush();

            return $this->redirectToRoute('app_administration_locatif', ['slug' => $locatif->getSlug()]);
        }

        $formDelInventaire->handleRequest($request);
        if($formDelInventaire->isSubmitted() && $formDelInventaire->isValid()){
            $data = $formDelInventaire->getData();

            $removeInventaire = $entityManager->getRepository(Inventaire::class)->find($data['id']);

            unlink('../public/pdf/inventaires/' . $removeInventaire->getPdfUrl());

            $entityManager->remove($removeInventaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_administration_locatif', ['slug' => $locatif->getSlug()]);
        }

        $formCoordonnees->handleRequest($request);
        if($formCoordonnees->isSubmitted() && $formCoordonnees->isValid()){
            $data = $formCoordonnees->getData();

            $updateCoordonnee = $entityManager->getRepository(CoordonneesMap::class)->find($data['id']);

            if($updateCoordonnee->getEmplacement() != $data['emplacement']){
                $updateCoordonnee->setEmplacement($data['emplacement']);
            }

            if($updateCoordonnee->getPosition() != $data['position']){
                $updateCoordonnee->setPosition($data['position']);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_administration_locatif', ['slug' => $locatif->getSlug()]);
        }

        return $this->render('/pages/administration_locatif/admin_locatif.html.twig', [
            'locatif' => $locatif,
            'coordonnees' => $coordonneesMap->toArray(),
            'images' => $images,
            'inventaire' => $inventaire,
            'tarifs' => $tarifs,
            'isPmr' => $isPmr,
            'formLocatifs' => $formLocatifs,
            'formImages' => $formImages,
            'formDelImages' => $formDelImages,
            'formVignettes' => $formVignettes,
            'formInventaire' => $formInventaire,
            'formDelInventaire' => $formDelInventaire,
            'formCoordonnees' => $formCoordonnees,
            'formTarifs' => $formTarifs,
        ]);
    }
}
