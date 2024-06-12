<?php

namespace App\Twig;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Map{
    public string $libelle;
    public array $coordonnee;
    public array $isPmr;

}