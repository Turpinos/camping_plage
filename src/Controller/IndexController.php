<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController{

    #[Route('/', name:'app_home')]
    public function index()
    {

        $page = [ 
            'libelle' => 'index',
            'title' => 'vivez le morvan des lacs & des sommets, une autre vie s\'invente ici'
        ];

        return $this->render('/pages/index/index.html.twig', [
            'page' => $page
        ]);
    }
}