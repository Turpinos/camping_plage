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

    #[ORM\Column(length: 100)]
    private ?string $img_url = null;

    #[ORM\Column]
    private ?bool $isPicture = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Locatifs $locatifs = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function isIsPicture(): ?bool
    {
        return $this->isPicture;
    }

    public function setIsPicture(bool $isPicture): static
    {
        $this->isPicture = $isPicture;

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
