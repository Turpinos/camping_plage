<?php

namespace App\Twig;

use App\Repository\LocatifsRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Map{
    public string $libelle;
    public array $coordonnee;
    public array $isPmr;
    //public LocatifsRepository $locatifs;
    //public array $loc = $locatifs->findAll();
    
}