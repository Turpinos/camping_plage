<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestMailController extends AbstractController
{
    #[Route('/mail', name: 'app_test_mail')]
    public function index(): Response
    {

        $title = [
            'title' => 'okk',
            'index' => 'lpl'
        ];

        return $this->render('test_mail/index.html.twig', [
            'controller_name' => 'TestMailController',
            'page' => $title
        ]);
    }
}
