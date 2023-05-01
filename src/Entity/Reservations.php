<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_res = null;

    #[ORM\Column]
    private ?float $prix_res = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $Utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Evenements $evenement = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Abonnements $Abonnements = null;

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

    public function getUtilisateur(): ?User
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?User $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

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

    public function getAbonnements(): ?Abonnements
    {
        return $this->Abonnements;
    }

    public function setAbonnements(?Abonnements $Abonnements): self
    {
        $this->Abonnements = $Abonnements;

        return $this;
    }
}
