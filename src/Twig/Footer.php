<?php

namespace App\Twig;

use App\Repository\InformationsRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Footer{
    private InformationsRepository $infoRepo;

    public function __construct(InformationsRepository $infoRepo)
    {
        $this->infoRepo = $infoRepo;
    }

    public function getInfo(): array
    {
        return $this->infoRepo->findAll();
    }
}