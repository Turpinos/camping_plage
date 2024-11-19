<?php

namespace App\Entity;

use App\Repository\InventaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventaireRepository::class)]
class Inventaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $pdf_url = null;

    #[ORM\ManyToOne(inversedBy: 'inventaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Locatifs $locatif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPdfUrl(): ?string
    {
        return $this->pdf_url;
    }

    public function setPdfUrl(string $pdf_url): static
    {
        $this->pdf_url = $pdf_url;

        return $this;
    }

    public function getLocatif(): ?Locatifs
    {
        return $this->locatif;
    }

    public function setLocatif(?Locatifs $locatif): static
    {
        $this->locatif = $locatif;

        return $this;
    }
}
