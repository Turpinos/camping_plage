<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?locatifs $id_locatifs = null;

    #[ORM\Column(length: 100)]
    private ?string $img_url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLocatifs(): ?locatifs
    {
        return $this->id_locatifs;
    }

    public function setIdLocatifs(?locatifs $id_locatifs): static
    {
        $this->id_locatifs = $id_locatifs;

        return $this;
    }

    public function getImgUrl(): ?string
    {
        return $this->img_url;
    }

    public function setImgUrl(string $img_url): static
    {
        $this->img_url = $img_url;

        return $this;
    }
}
