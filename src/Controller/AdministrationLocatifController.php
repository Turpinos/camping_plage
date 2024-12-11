<?php

namespace App\Controller;

use App\Form\CoordonneeType;
use App\Form\DeleteGalleryType;
use App\Form\GalleryType;
use App\Form\InventaireType;
use App\Form\LocatifType;
use App\Form\TarifsCabaneType;
use App\Form\TarifsCampingType;
use App\Form\TarifsChaletType;
use App\Repository\CoordonneesMapRepository;
use App\Repository\ImagesRepository;
use App\Repository\InventaireRepository;
use App\Repository\LocatifsRepository;
use App\Repository\TarifsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdministrationLocatifController extends AbstractController
{
    #[Route('/administration/locatif/{slug}', name: 'app_administration_locatif')]
    public function index(LocatifsRepository $locatifsRepository, CoordonneesMapRepository $coordonneesMapRepository, ImagesRepository $imagesRepository, InventaireRepository $inventaireRepository, TarifsRepository $tarifsRepository, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, string $slug = null): Response
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

        $formLocatifs = $formFactory->createNamed('form_locatifs', LocatifType::class);
        $formImages = $formFactory->createNamed('form_images', GalleryType::class);
        $formDelImages = $formFactory->createNamed('form_delImages', DeleteGalleryType::class);
        $formVignettes = $formFactory->createNamed('form_vignette', GalleryType::class);
        $formInventaire = $formFactory->createNamed('form_inventaire', InventaireType::class);
        $formDelInventaire = $formFactory->createNamed('form_delInventaire', DeleteGalleryType::class);
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

        return $this->render('/pages/administration_locatif/admin_locatif.html.twig', [
            'locatif' => $locatif,
            'coordonnees' => $coordonneesMap,
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
            'formTarifs' => $formTarifs
        ]);
    }
}
