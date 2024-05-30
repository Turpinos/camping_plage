<?php

namespace App\Entity;

use App\Repository\LocatifsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocatifsRepository::class)]
class Locatifs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $capacite = null;

    #[ORM\Column(nullable: true)]
    private ?int $superficie = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $mode_paiement = null;

    #[ORM\Column]
    private ?bool $pmr = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeLocatifs $type_locatifs = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?tarifs $tarifs = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCapacite(): ?string
    {
        return $this->capacite;
    }

    public function setCapacite(?string $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(?int $superficie): static
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->mode_paiement;
    }

    public function setModePaiement(?string $mode_paiement): static
    {
        $this->mode_paiement = $mode_paiement;

        return $this;
    }

    public function isPmr(): ?bool
    {
        return $this->pmr;
    }

    public function setPmr(bool $pmr): static
    {
        $this->pmr = $pmr;

        return $this;
    }

    public function getIdTypeLocatifs(): ?TypeLocatifs
    {
        return $this->type_locatifs;
    }

    public function setIdTypeLocatifs(?TypeLocatifs $type_locatifs): static
    {
        $this->type_locatifs = $type_locatifs;

        return $this;
    }

    public function getIdTarifs(): ?tarifs
    {
        return $this->tarifs;
    }

    public function setIdTarifs(tarifs $tarifs): static
    {
        $this->tarifs = $tarifs;

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
