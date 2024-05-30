<?php

namespace App\Entity;

use App\Repository\TarifsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarifsRepository::class)]
class Tarifs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $hs_semaine = null;

    #[ORM\Column(nullable: true)]
    private ?int $bs_nuitee = null;

    #[ORM\Column(nullable: true)]
    private ?int $bs_semaine = null;

    #[ORM\Column(nullable: true)]
    private ?int $caution = null;

    #[ORM\Column(nullable: true)]
    private ?int $arrhes_nuitee = null;

    #[ORM\Column(nullable: true)]
    private ?int $arrhes_semaine = null;

    #[ORM\Column(nullable: true)]
    private ?int $tv_jour = null;

    #[ORM\Column(nullable: true)]
    private ?int $tv_semaine = null;

    #[ORM\Column(nullable: true)]
    private ?float $animaux = null;

    #[ORM\Column(nullable: true)]
    private ?int $hv_nuitee = null;

    #[ORM\Column(nullable: true)]
    private ?int $hv_semaine = null;

    #[ORM\Column(nullable: true)]
    private ?int $bs_nuitee_2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $bs_nuitee_3 = null;

    #[ORM\Column(nullable: true)]
    private ?int $bs_nuitee_4 = null;

    #[ORM\Column(nullable: true)]
    private ?int $hs_nuitee_2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $hs_nuitee_3 = null;

    #[ORM\Column(nullable: true)]
    private ?int $hs_nuitee_4 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $dej_inclu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHsSemaine(): ?int
    {
        return $this->hs_semaine;
    }

    public function setHsSemaine(?int $hs_semaine): static
    {
        $this->hs_semaine = $hs_semaine;

        return $this;
    }

    public function getBsNuitee(): ?int
    {
        return $this->bs_nuitee;
    }

    public function setBsNuitee(?int $bs_nuitee): static
    {
        $this->bs_nuitee = $bs_nuitee;

        return $this;
    }

    public function getBsSemaine(): ?int
    {
        return $this->bs_semaine;
    }

    public function setBsSemaine(?int $bs_semaine): static
    {
        $this->bs_semaine = $bs_semaine;

        return $this;
    }

    public function getCaution(): ?int
    {
        return $this->caution;
    }

    public function setCaution(int $caution): static
    {
        $this->caution = $caution;

        return $this;
    }

    public function getArrhesNuitee(): ?int
    {
        return $this->arrhes_nuitee;
    }

    public function setArrhesNuitee(int $arrhes_nuitee): static
    {
        $this->arrhes_nuitee = $arrhes_nuitee;

        return $this;
    }

    public function getArrhesSemaine(): ?int
    {
        return $this->arrhes_semaine;
    }

    public function setArrhesSemaine(int $arrhes_semaine): static
    {
        $this->arrhes_semaine = $arrhes_semaine;

        return $this;
    }

    public function getTvJour(): ?int
    {
        return $this->tv_jour;
    }

    public function setTvJour(?int $tv_jour): static
    {
        $this->tv_jour = $tv_jour;

        return $this;
    }

    public function getTvSemaine(): ?int
    {
        return $this->tv_semaine;
    }

    public function setTvSemaine(?int $tv_semaine): static
    {
        $this->tv_semaine = $tv_semaine;

        return $this;
    }

    public function getAnimaux(): ?float
    {
        return $this->animaux;
    }

    public function setAnimaux(?float $animaux): static
    {
        $this->animaux = $animaux;

        return $this;
    }

    public function getHvNuitee(): ?int
    {
        return $this->hv_nuitee;
    }

    public function setHvNuitee(?int $hv_nuitee): static
    {
        $this->hv_nuitee = $hv_nuitee;

        return $this;
    }

    public function getHvSemaine(): ?int
    {
        return $this->hv_semaine;
    }

    public function setHvSemaine(?int $hv_semaine): static
    {
        $this->hv_semaine = $hv_semaine;

        return $this;
    }

    public function getBsNuitee2(): ?int
    {
        return $this->bs_nuitee_2;
    }

    public function setBsNuitee2(?int $bs_nuitee_2): static
    {
        $this->bs_nuitee_2 = $bs_nuitee_2;

        return $this;
    }

    public function getBsNuitee3(): ?int
    {
        return $this->bs_nuitee_3;
    }

    public function setBsNuitee3(?int $bs_nuitee_3): static
    {
        $this->bs_nuitee_3 = $bs_nuitee_3;

        return $this;
    }

    public function getBsNuitee4(): ?int
    {
        return $this->bs_nuitee_4;
    }

    public function setBsNuitee4(?int $bs_nuitee_4): static
    {
        $this->bs_nuitee_4 = $bs_nuitee_4;

        return $this;
    }

    public function getHsNuitee2(): ?int
    {
        return $this->hs_nuitee_2;
    }

    public function setHsNuitee2(?int $hs_nuitee_2): static
    {
        $this->hs_nuitee_2 = $hs_nuitee_2;

        return $this;
    }

    public function getHsNuitee3(): ?int
    {
        return $this->hs_nuitee_3;
    }

    public function setHsNuitee3(?int $hs_nuitee_3): static
    {
        $this->hs_nuitee_3 = $hs_nuitee_3;

        return $this;
    }

    public function getHsNuitee4(): ?int
    {
        return $this->hs_nuitee_4;
    }

    public function setHsNuitee4(?int $hs_nuitee_4): static
    {
        $this->hs_nuitee_4 = $hs_nuitee_4;

        return $this;
    }

    public function isDejInclu(): ?bool
    {
        return $this->dej_inclu;
    }

    public function setDejInclu(?bool $dej_inclu): static
    {
        $this->dej_inclu = $dej_inclu;

        return $this;
    }
}
