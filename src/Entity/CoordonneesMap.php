<?php

namespace App\Entity;

use App\Repository\CoordonneesMapRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoordonneesMapRepository::class)]
class CoordonneesMap
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $emplacement = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $position = null;

    #[ORM\ManyToOne(inversedBy: 'coordonneesMaps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Locatifs $locatifs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmplacement(): ?int
    {
        return $this->emplacement;
    }

    public function setEmplacement(?int $emplacement): static
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getLocatifs(): ?Locatifs
    {
        return $this->locatifs;
    }

    public function setLocatifs(?Locatifs $locatifs): static
    {
        $this->locatifs = $locatifs;

        return $this;
    }
}
