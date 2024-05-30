<?php

namespace App\Twig;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Map{
    public string $libelle;
    public array $pings = [
        [
            'emplacement' => 3,
            'position' => 'top:28%; left:83%'
        ],
        [
            'emplacement' => 4,
            'position' => 'top:26%; left:85%'
        ],
        [
            'emplacement' => 7,
            'position' => 'top:7%; left:76%'
        ],
        [
            'emplacement' => 8,
            'position' => 'top:11%; left:80%'
        ]
        
    ];
}