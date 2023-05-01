<?php

namespace App\Entity;

use App\Repository\NourrituresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NourrituresRepository::class)]
class Nourritures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_nourriture = null;

    #[ORM\Column(length: 50)]
    private ?string $origine_nourriture = null;

    #[ORM\Column(length: 500)]
    private ?string $ingrediant = null;

    #[ORM\Column]
    private ?float $prix_nourriture = null;

    #[ORM\Column(length: 5000)]
    private ?string $description_nourriture = null;

    #[ORM\Column(length: 255)]
    private ?string $type_nourriture = null;

    #[ORM\Column(length: 344)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'nourritures')]
    private ?User $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'nourritures')]
    private ?Civilisation $civilisation = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomNourriture(): ?string
    {
        return $this->nom_nourriture;
    }

    public function setNomNourriture(string $nom_nourriture): self
    {
        $this->nom_nourriture = $nom_nourriture;

        return $this;
    }

    public function getOrigineNourriture(): ?string
    {
        return $this->origine_nourriture;
    }

    public function setOrigineNourriture(string $origine_nourriture): self
    {
        $this->origine_nourriture = $origine_nourriture;

        return $this;
    }

    public function getIngrediant(): ?string
    {
        return $this->ingrediant;
    }

    public function setIngrediant(string $ingrediant): self
    {
        $this->ingrediant = $ingrediant;

        return $this;
    }

    public function getPrixNourriture(): ?float
    {
        return $this->prix_nourriture;
    }

    public function setPrixNourriture(float $prix_nourriture): self
    {
        $this->prix_nourriture = $prix_nourriture;

        return $this;
    }

    public function getDescriptionNourriture(): ?string
    {
        return $this->description_nourriture;
    }

    public function setDescriptionNourriture(string $description_nourriture): self
    {
        $this->description_nourriture = $description_nourriture;

        return $this;
    }

    public function getTypeNourriture(): ?string
    {
        return $this->type_nourriture;
    }

    public function setTypeNourriture(string $type_nourriture): self
    {
        $this->type_nourriture = $type_nourriture;

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

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getCivilisation(): ?Civilisation
    {
        return $this->civilisation;
    }

    public function setCivilisation(?Civilisation $civilisation): self
    {
        $this->civilisation = $civilisation;

        return $this;
    }
    public function __toString()
    {
        return $this->nom_nourriture; // remplacer nomDeLaPropriete par le nom de la propriété que vous souhaitez afficher
    }
}
