<?php

namespace App\Controller;

use App\Repository\CoordonneesMapRepository;
use App\Repository\ImagesRepository;
use App\Repository\InventaireRepository;
use App\Repository\LocatifsRepository;
use App\Repository\TarifsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdministrationLocatifController extends AbstractController
{
    #[Route('/administration/locatif/{slug}', name: 'app_administration_locatif')]
    public function index(LocatifsRepository $locatifsRepository, CoordonneesMapRepository $coordonneesMapRepository, ImagesRepository $imagesRepository, InventaireRepository $inventaireRepository, TarifsRepository $tarifsRepository, string $slug = null): Response
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


        //Récuperation des infos modifiable..
        $locatif = $locatifsRepository->findOneBy(['slug' => $slug]);
        $coordonneesMap = $coordonneesMapRepository->findBy(['locatifs' => $locatif->getId()]);
        $images = $imagesRepository->findBy(['id_locatifs' => $locatif->getId()]);
        $inventaire = $inventaireRepository->findBy(['locatif' => $locatif->getId()]);
        $tarifs = $tarifsRepository->findOneBy(['id' => $locatif->getIdTarifs()]);

        $isPmr = [];
        if($locatif->isPmr() == "1"){
            $isPmr[] = $locatif->getId();
        }

        return $this->render('/pages/administration_locatif/admin_locatif.html.twig', [
            'locatif' => $locatif,
            'coordonnees' => $coordonneesMap,
            'images' => $images,
            'inventaire' => $inventaire,
            'tarifs' => $tarifs,
            'isPmr' => $isPmr
        ]);
    }
}
