<?php

namespace App\Controller;

use App\Repository\CoordonneesMapRepository;
use App\Repository\ImagesRepository;
use App\Repository\LocatifsRepository;
use App\Repository\TypeLocatifsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LocatifsController extends AbstractController{

    #[Route('/locatifs/{slug}', name:'locatifs')]
    public function locatifs(LocatifsRepository $locatifsRepository, CoordonneesMapRepository $coordonneesMapRepository, ImagesRepository $imagesRepository, TypeLocatifsRepository $typeLocatifsRepository ,string $slug = null){

        $typeLocatifs= [];
        $page = [];
        $locatifs = [];
        $coordonneesMap = [];
        $images = [];
        $isPmr = [];

        if($slug == null){

            $page = [ 
                'libelle' => 'locatifs',
                'title' => 'Nos locations'
                
            ];
            $typeLocatifs = $typeLocatifsRepository->findAll();
            $locatifs = $locatifsRepository->findAll();
            $coordonneesMap = $coordonneesMapRepository->findAll();
            $images = $imagesRepository->findAll();

            foreach ($locatifs as $locatif) {
                if($locatif->isPmr() == "1"){
                    $isPmr[] = $locatif->getId();
                }
            }

        }elseif($slug == "hiver"){
            $page = [ 
                'libelle' => 'locatifs_hiver',
                'title' => 'Nos locations d\'hiver'
                
            ];
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
}