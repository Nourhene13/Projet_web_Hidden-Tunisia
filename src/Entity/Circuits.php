<?php

namespace App\Entity;

use App\Repository\CircuitsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CircuitsRepository::class)]
class Circuits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $point_depat_circuit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_debut_circuit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fin_circuit = null;

    #[ORM\Column]
    private ?int $nbr_place_dispo = null;

    #[ORM\Column(length: 8000)]
    private ?string $description_circuit = null;

    #[ORM\Column]
    private ?int $nbr_jour_circuit = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_circuit = null;

    #[ORM\ManyToOne(inversedBy: 'circuits')]
    private ?User $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPointDepatCircuit(): ?string
    {
        return $this->point_depat_circuit;
    }

    public function setPointDepatCircuit(string $point_depat_circuit): self
    {
        $this->point_depat_circuit = $point_depat_circuit;

        return $this;
    }

    public function getDateDebutCircuit(): ?\DateTimeInterface
    {
        return $this->date_debut_circuit;
    }

    public function setDateDebutCircuit(\DateTimeInterface $date_debut_circuit): self
    {
        $this->date_debut_circuit = $date_debut_circuit;

        return $this;
    }

    public function getDateFinCircuit(): ?\DateTimeInterface
    {
        return $this->date_fin_circuit;
    }

    public function setDateFinCircuit(\DateTimeInterface $date_fin_circuit): self
    {
        $this->date_fin_circuit = $date_fin_circuit;

        return $this;
    }

    public function getNbrPlaceDispo(): ?int
    {
        return $this->nbr_place_dispo;
    }

    public function setNbrPlaceDispo(int $nbr_place_dispo): self
    {
        $this->nbr_place_dispo = $nbr_place_dispo;

        return $this;
    }

    public function getDescriptionCircuit(): ?string
    {
        return $this->description_circuit;
    }

    public function setDescriptionCircuit(string $description_circuit): self
    {
        $this->description_circuit = $description_circuit;

        return $this;
    }

    public function getNbrJourCircuit(): ?int
    {
        return $this->nbr_jour_circuit;
    }

    public function setNbrJourCircuit(int $nbr_jour_circuit): self
    {
        $this->nbr_jour_circuit = $nbr_jour_circuit;

        return $this;
    }

    public function getNomCircuit(): ?string
    {
        return $this->nom_circuit;
    }

    public function setNomCircuit(string $nom_circuit): self
    {
        $this->nom_circuit = $nom_circuit;

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
