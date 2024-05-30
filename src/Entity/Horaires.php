<?php

namespace App\Entity;

use App\Repository\HorairesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HorairesRepository::class)]
class Horaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $horaire_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $horaire_fin = null;

    #[ORM\Column(length: 50)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getHoraireDebut(): ?\DateTimeInterface
    {
        return $this->horaire_debut;
    }

    public function setHoraireDebut(\DateTimeInterface $horaire_debut): static
    {
        $this->horaire_debut = $horaire_debut;

        return $this;
    }

    public function getHoraireFin(): ?\DateTimeInterface
    {
        return $this->horaire_fin;
    }

    public function setHoraireFin(\DateTimeInterface $horaire_fin): static
    {
        $this->horaire_fin = $horaire_fin;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
