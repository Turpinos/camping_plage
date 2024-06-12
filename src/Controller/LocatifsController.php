<?php

namespace App\Controller;

use App\Repository\TarifsRepository;
use App\Repository\TypeLocatifsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LocatifsController extends AbstractController{

    #[Route('/locatifs/{slug}', name:'locatifs')]
    public function locatifs(TarifsRepository $tarifsRepository, TypeLocatifsRepository $typeLocatifsRepository ,string $slug = null){

        $typeLocatifs= [];
        $page = [];
        if($slug == null){
            $page = [ 
                'libelle' => 'locatifs',
                'title' => 'Nos locations'
                
            ];
            $typeLocatifs = $typeLocatifsRepository->findAll();
        }elseif($slug == "hiver"){
            $page = [ 
                'libelle' => 'locatifs_hiver',
                'title' => 'Nos locations d\'hiver'
                
            ];
        }
        
        
        return $this->render('/pages/locatifs/locatifs.html.twig', [
            'page' => $page,
            'typeLocatifs' => $typeLocatifs
        ]);
    }
}