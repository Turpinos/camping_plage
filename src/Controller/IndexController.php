<?php

namespace App\Controller;

use App\Repository\CoordonneesMapRepository;
use App\Repository\LocatifsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController{

    #[Route('/', name:'app_home')]
    public function index(CoordonneesMapRepository $coordonneMap, LocatifsRepository $locatifs)
    {
        $listLocatifs = $locatifs->findAll();
        $listCoordonnee = $coordonneMap->findAll();
        $isPmr = [];
        $chalets = [];
        $cabanes = [];
        $roulottes = [];

        for($i = 0; $i<count($listLocatifs); $i++){
            if($listLocatifs[$i]->getIdTypeLocatifs()->getId() == 2){
                $chalets[] = $listLocatifs[$i];
            }elseif($listLocatifs[$i]->getIdTypeLocatifs()->getId() == 1){
                $cabanes[] = $listLocatifs[$i];
            }elseif($listLocatifs[$i]->getIdTypeLocatifs()->getId() == 4){
                $roulottes[] = $listLocatifs[$i];
            }
        }

        $countChalets = 0;
        for($i = 0; $i<count($listCoordonnee); $i++){
            foreach($chalets as $chalet){
                if($listCoordonnee[$i]->getIdLocatifs()->getId() == $chalet->getId()){
                    $countChalets++;
                }
            }
            
        }

        $countCabanes = 0;
        for($i = 0; $i<count($listCoordonnee); $i++){
            foreach($cabanes as $cabane){
                if($listCoordonnee[$i]->getIdLocatifs()->getId() == $cabane->getId()){
                    $countCabanes++;
                }
            }
            
        }

        $countRoulottes = 0;
        for($i = 0; $i<count($listCoordonnee); $i++){
            foreach($roulottes as $roulotte){
                if($listCoordonnee[$i]->getIdLocatifs()->getId() == $roulotte->getId()){
                    $countRoulottes++;
                }
            }
            
        }

        foreach ($listLocatifs as $locatif) {
            if($locatif->isPmr() == "1"){
                $isPmr[] = $locatif->getId();
            }
        }

        $page = [ 
            'libelle' => 'index',
            'title' => 'vivez le morvan des lacs & des sommets, une autre vie s\'invente ici'
            
        ];

        return $this->render('/pages/index/index.html.twig', [
            'page' => $page,
            'locations' => $listLocatifs,
            'coordonnee' => $listCoordonnee,
            'isPmr' => $isPmr,
            'countChalets' => $countChalets,
            'countCabanes' => $countCabanes,
            'countRoulottes' => $countRoulottes
            
        ]);
    }
}