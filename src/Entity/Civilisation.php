<?php

namespace App\Entity;

use App\Repository\CivilisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CivilisationRepository::class)]
class Civilisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_civilisation = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_monument = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_dbuit_civilisation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin_civilisation = null;

    #[ORM\Column(length: 6000)]
    private ?string $description_civilisation = null;

    #[ORM\Column(length: 344)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'civilisation', targetEntity: Nourritures::class)]
    private Collection $nourritures;

    #[ORM\ManyToOne(inversedBy: 'civilisations')]
    private ?User $utilisateur = null;

    public function __construct()
    {
        $this->nourritures = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->id; // remplacer nomDeLaPropriete par le nom de la propriété que vous souhaitez afficher
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCivilisation(): ?string
    {
        return $this->nom_civilisation;
    }

    public function setNomCivilisation(string $nom_civilisation): self
    {
        $this->nom_civilisation = $nom_civilisation;

        return $this;
    }

    public function getNomMonument(): ?string
    {
        return $this->nom_monument;
    }

    public function setNomMonument(string $nom_monument): self
    {
        $this->nom_monument = $nom_monument;

        return $this;
    }

    public function getDateDbuitCivilisation(): ?\DateTimeInterface
    {
        return $this->date_dbuit_civilisation;
    }

    public function setDateDbuitCivilisation(\DateTimeInterface $date_dbuit_civilisation): self
    {
        $this->date_dbuit_civilisation = $date_dbuit_civilisation;

        return $this;
    }

    public function getDateFinCivilisation(): ?\DateTimeInterface
    {
        return $this->date_fin_civilisation;
    }

    public function setDateFinCivilisation(\DateTimeInterface $date_fin_civilisation): self
    {
        $this->date_fin_civilisation = $date_fin_civilisation;

        return $this;
    }

    public function getDescriptionCivilisation(): ?string
    {
        return $this->description_civilisation;
    }

    public function setDescriptionCivilisation(string $description_civilisation): self
    {
        $this->description_civilisation = $description_civilisation;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Nourritures>
     */
    public function getNourritures(): Collection
    {
        return $this->nourritures;
    }

    public function addNourriture(Nourritures $nourriture): self
    {
        if (!$this->nourritures->contains($nourriture)) {
            $this->nourritures->add($nourriture);
            $nourriture->setCivilisation($this);
        }

        return $this;
    }

    public function removeNourriture(Nourritures $nourriture): self
    {
        if ($this->nourritures->removeElement($nourriture)) {
            // set the owning side to null (unless already changed)
            if ($nourriture->getCivilisation() === $this) {
                $nourriture->setCivilisation(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
