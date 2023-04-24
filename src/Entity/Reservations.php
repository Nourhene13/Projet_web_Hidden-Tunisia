<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "Please  fill out the title")]
    private ?\DateTimeInterface $date_res = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero(message: "The value must be a positive number or zero")]
    private ?float $prix_res = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[Assert\NotBlank(message: "Please  fill out the title")]
    private ?Abonnements $Abonnements = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[Assert\NotBlank(message: "Please  fill out the title")]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[Assert\NotBlank(message: "Please  fill out the title")]
    private ?Evenements $evenement = null;

    #[ORM\Column]
    private ?int $nbplaces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRes(): ?\DateTimeInterface
    {
        return $this->date_res;
    }

    public function setDateRes(\DateTimeInterface $date_res): self
    {
        $this->date_res = $date_res;

        return $this;
    }

    public function getPrixRes(): ?float
    {
        return $this->prix_res;
    }

    public function setPrixRes(float $prix_res): self
    {
        $this->prix_res = $prix_res;

        return $this;
    }

    public function getAbonnements(): ?Abonnements
    {
        return $this->Abonnements;
    }

    public function setAbonnements(?Abonnements $Abonnements): self
    {
        $this->Abonnements = $Abonnements;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getEvenement(): ?Evenements
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenements $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    public function getNbplaces(): ?int
    {
        return $this->nbplaces;
    }

    public function setNbplaces(int $nbplaces): self
    {
        $this->nbplaces = $nbplaces;

        return $this;
    }
}
