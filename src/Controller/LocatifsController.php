<?php

namespace App\Controller;

use App\Repository\CoordonneesMapRepository;
use App\Repository\ImagesRepository;
use App\Repository\InformationsRepository;
use App\Repository\LocatifsRepository;
use App\Repository\TarifsGlobauxRepository;
use App\Repository\TarifsRepository;
use App\Repository\TypeLocatifsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LocatifsController extends AbstractController{

    #[Route('/locatifs/{slug}', name:'locatifs')]
    public function locatifs(LocatifsRepository $locatifsRepository, CoordonneesMapRepository $coordonneesMapRepository, ImagesRepository $imagesRepository, TypeLocatifsRepository $typeLocatifsRepository,string $slug = null){

        $typeLocatifs= [];
        $page = '';
        $locatifs = [];
        $coordonneesMap = [];
        $images = [];
        $isPmr = [];

        if($slug == null){

            $page = 'Nos locations';
            $typeLocatifs = $typeLocatifsRepository->findAll();
            $locatifs = $locatifsRepository->findBy([],['slug' => 'ASC']);
            $coordonneesMap = $coordonneesMapRepository->findAll();
            $images = $imagesRepository->findBy(['isPicture' => '1']);

            foreach ($locatifs as $locatif) {
                if($locatif->isPmr() == "1"){
                    $isPmr[] = $locatif->getId();
                }
            }

        }elseif($slug == "hiver"){
            $page = 'Nos locations d\'hiver';

            $locatifs = $locatifsRepository->findBy(['ouverture_hivernale' => '1'],['slug' => 'ASC']);
            $images = $imagesRepository->findBy(['isPicture' => "1"]);
            $coordonneesMap = $coordonneesMapRepository->findAll();

            foreach($locatifs as $locatif){
                $isIn = false;
                foreach($typeLocatifs as $typeLocatif){
                    if($typeLocatif->getId() == $locatif->getIdTypeLocatifs()->getId()){
                        $isIn = true;
                    }
                }

                if(!$isIn){
                    $typeLocatifs[] = $typeLocatifsRepository->findOneBy(['id' => $locatif->getIdTypeLocatifs()->getId()]);
                }
            }            
            
            foreach ($locatifs as $locatif) {
                if($locatif->isPmr() == "1"){
                    $isPmr[] = $locatif->getId();
                }
            }
        }
        
        
        return $this->render('/pages/locatifs/locatifs.html.twig', [
            'page' => $page,
            'typeLocatifs' => $typeLocatifs,
            'locatifs' => $locatifs,
            'coordonneesMap' => $coordonneesMap,
            'images' => $images,
            'isPmr' => $isPmr
        ]);
    }

    #[Route('/locatifs_details/{slug}', name:'locatifs_details')]
    public function locatifs_details(LocatifsRepository $locatifsRepository, TarifsRepository $tarifsRepository, TarifsGlobauxRepository $tarifsGlobauxRepository, ImagesRepository $imagesRepository, CoordonneesMapRepository $coordonneesMapRepository, InformationsRepository $informationsRepository ,string $slug){

        $locatif = $locatifsRepository->findOneBy(['slug' => $slug]);
        $descrition = (preg_split('/[.]+[[:space:]]/mi', $locatif->getDescription()));
        $tarifs = $tarifsRepository->findOneBy(['id' => $locatif->getIdTarifs()->getId()]);
        $images = $imagesRepository->findBy(['id_locatifs' => $locatif->getId()]);
        $coordonneesMap = $coordonneesMapRepository->findBy(['locatifs' => $locatif->getId()]);
        $tarifsGlobaux = $tarifsGlobauxRepository->findAll();
        $tel = $informationsRepository->findOneBy(['slug' => 'telephone']);

        $isPmr = [];
        if($locatif->isPmr() == "1"){
            $isPmr[] = $locatif->getId();
        }

        return $this->render('/pages/locatifs/locatifs_details.html.twig', [
            'locatif' => $locatif,
            'tarifs' => $tarifs,
            'images' => $images,
            'tarifsGlobaux' => $tarifsGlobaux,
            'coordonnees' => $coordonneesMap,
            'description' => $descrition,
            'telephone' => $tel,
            'isPmr' => $isPmr
        ]);
    }
}