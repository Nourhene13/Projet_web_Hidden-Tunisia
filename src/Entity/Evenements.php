<?php

namespace App\Entity;

use App\Repository\EvenementsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EvenementsRepository::class)]
class Evenements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Please  fill out the title")]
    private ?string $titre_evenement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Please  fill out the title")]
    private ?string $type_evenement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"Please select a  date for the Event.")]
    private ?\DateTimeInterface $date_evenement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Please  fill out the title")]
    private ?string $lieux_evenement = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Please  fill out the title")]
    #[Assert\PositiveOrZero(message:"The value must be a positive number or zero")]
    private ?float $prix_evenement = null;

    #[ORM\Column(length: 8000)]
    #[Assert\NotBlank(message:"Please  fill out the title")]
    private ?string $description_evenement = null;

    #[ORM\Column(length: 300)]
    #[Assert\NotBlank(message:"Please  fill out the title")]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[Assert\NotBlank(message:"Please  fill out the title")]
    private ?Utilisateur $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreEvenement(): ?string
    {
        return $this->titre_evenement;
    }

    public function setTitreEvenement(string $titre_evenement): self
    {
        $this->titre_evenement = $titre_evenement;

        return $this;
    }

    public function getTypeEvenement(): ?string
    {
        return $this->type_evenement;
    }

    public function setTypeEvenement(string $type_evenement): self
    {
        $this->type_evenement = $type_evenement;

        return $this;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->date_evenement;
    }

    public function setDateEvenement(\DateTimeInterface $date_evenement): self
    {
        $this->date_evenement = $date_evenement;

        return $this;
    }

    public function getLieuxEvenement(): ?string
    {
        return $this->lieux_evenement;
    }

    public function setLieuxEvenement(string $lieux_evenement): self
    {
        $this->lieux_evenement = $lieux_evenement;

        return $this;
    }

    public function getPrixEvenement(): ?float
    {
        return $this->prix_evenement;
    }

    public function setPrixEvenement(float $prix_evenement): self
    {
        $this->prix_evenement = $prix_evenement;

        return $this;
    }

    public function getDescriptionEvenement(): ?string
    {
        return $this->description_evenement;
    }

    public function setDescriptionEvenement(string $description_evenement): self
    {
        $this->description_evenement = $description_evenement;

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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
