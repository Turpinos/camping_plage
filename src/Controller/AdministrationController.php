<?php

namespace App\Controller;


use App\Repository\AccesPmrRepository;
use App\Repository\CoordonneesMapRepository;
use App\Repository\GalleryRepository;
use App\Repository\ImagesRepository;
use App\Repository\InformationsRepository;
use App\Repository\LocatifsRepository;
use App\Repository\OuverturesRepository;
use App\Repository\SaisonsRepository;
use App\Repository\TarifsGlobauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdministrationController extends AbstractController
{
    #[Route('/administration', name: 'app_administration')]
    public function index(LocatifsRepository $locatifsRepository, ImagesRepository $imagesRepository, CoordonneesMapRepository $coordonneesMapRepository, SaisonsRepository $saisonsRepository, OuverturesRepository $ouverturesRepository, GalleryRepository $galleryRepository, InformationsRepository $informationsRepository, TarifsGlobauxRepository $tarifsGlobauxRepository, AccesPmrRepository $accesPmrRepository): Response
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

        return $this->render('pages/administration/admin.html.twig', [
            'locatifs' => $locatifs,
            'images' => $images,
            'emplacements' => $emplacements,
            'saisons' => $saisons,
            'ouvertures' => $ouvertures,
            'gallery' => $gallery,
            'informations' => $informations,
            'tarifs' => $tarifs,
            'accesPmr' => $accesPmr
        ]);
    }
}
