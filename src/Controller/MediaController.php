<?php

namespace App\Controller;

use App\Repository\GalleryRepository;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
{
    #[Route('/media/{slug}', name: 'media')]
    public function index(ImagesRepository $imagesRepository,GalleryRepository $galleryRepository , string $slug = null): Response
    {   
        $imagesLocatifs = [];
        $imagesGallery = [];

        if( $slug != 'locatifs' && $slug != 'gallery'){
            $slug = null;
        }

        if($slug == null){

            $imagesLocatifs = $imagesRepository->findByLimit(3);
            $imagesGallery = $galleryRepository->findByLimit(3);

        }else{

            if($slug == 'locatifs'){

                $imagesLocatifs = $imagesRepository->findAll();

            }elseif ($slug == 'gallery') {
                
                $imagesGallery = $galleryRepository->findAll();

            }else{

                $this->redirectToRoute('media');

            }
            
            
            

        }

        $page = 'Photo & vidéo';

        return $this->render('/pages/media/media.html.twig', [
            'page' => $page,
            'slug' => $slug,
            'imagesLocatifs' => $imagesLocatifs,
            'imagesGallery' => $imagesGallery
        ]);
    }
}
