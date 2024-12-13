<?php

namespace App\Entity;

use App\Repository\LocatifsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column]
    private ?bool $pmr = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeLocatifs $type_locatifs = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tarifs $tarifs = null;

    #[ORM\Column(length: 50)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?bool $ouverture_hivernale = null;

    /**
     * @var Collection<int, Inventaire>
     */
    #[ORM\OneToMany(targetEntity: Inventaire::class, mappedBy: 'locatif', orphanRemoval: true)]
    private Collection $inventaires;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'locatifs', orphanRemoval: true)]
    private Collection $images;

    /**
     * @var Collection<int, CoordonneesMap>
     */
    #[ORM\OneToMany(targetEntity: CoordonneesMap::class, mappedBy: 'locatifs', orphanRemoval: true)]
    private Collection $coordonneesMaps;

    public function __construct()
    {
        $this->inventaires = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->coordonneesMaps = new ArrayCollection();
    }

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

    public function getIdTarifs(): ?Tarifs
    {
        return $this->tarifs;
    }

    public function setIdTarifs(Tarifs $tarifs): static
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

    public function isOuvertureHivernale(): ?bool
    {
        return $this->ouverture_hivernale;
    }

    public function setOuvertureHivernale(bool $ouverture_hivernale): static
    {
        $this->ouverture_hivernale = $ouverture_hivernale;

        return $this;
    }

    /**
     * @return Collection<int, Inventaire>
     */
    public function getInventaires(): Collection
    {
        return $this->inventaires;
    }

    public function addInventaire(Inventaire $inventaire): static
    {
        if (!$this->inventaires->contains($inventaire)) {
            $this->inventaires->add($inventaire);
            $inventaire->setLocatif($this);
        }

        return $this;
    }

    public function removeInventaire(Inventaire $inventaire): static
    {
        if ($this->inventaires->removeElement($inventaire)) {
            // set the owning side to null (unless already changed)
            if ($inventaire->getLocatif() === $this) {
                $inventaire->setLocatif(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setLocatifs($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getLocatifs() === $this) {
                $image->setLocatifs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoordonneesMap>
     */
    public function getCoordonneesMaps(): Collection
    {
        return $this->coordonneesMaps;
    }

    public function addCoordonneesMap(CoordonneesMap $coordonneesMap): static
    {
        if (!$this->coordonneesMaps->contains($coordonneesMap)) {
            $this->coordonneesMaps->add($coordonneesMap);
            $coordonneesMap->setLocatifs($this);
        }

        return $this;
    }

    public function removeCoordonneesMap(CoordonneesMap $coordonneesMap): static
    {
        if ($this->coordonneesMaps->removeElement($coordonneesMap)) {
            // set the owning side to null (unless already changed)
            if ($coordonneesMap->getLocatifs() === $this) {
                $coordonneesMap->setLocatifs(null);
            }
        }

        return $this;
    }

}
