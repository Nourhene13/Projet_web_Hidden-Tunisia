<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomUtilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomUtilisateur = null;

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: Circuits::class)]
    private Collection $circuits;

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: Evenements::class)]
    private Collection $evenements;

    public function __construct()
    {
        $this->circuits = new ArrayCollection();
        $this->evenements = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id;
 
    }
    
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $prenomUtilisateur): self
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Circuits>
     */
    public function getCircuits(): Collection
    {
        return $this->circuits;
    }

    public function addCircuit(Circuits $circuit): self
    {
        if (!$this->circuits->contains($circuit)) {
            $this->circuits->add($circuit);
            $circuit->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCircuit(Circuits $circuit): self
    {
        if ($this->circuits->removeElement($circuit)) {
            // set the owning side to null (unless already changed)
            if ($circuit->getUtilisateur() === $this) {
                $circuit->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evenements>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenements $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setUtilisateur($this);
        }

        return $this;
    }

    public function removeEvenement(Evenements $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getUtilisateur() === $this) {
                $evenement->setUtilisateur(null);
            }
        }

        return $this;
    }
}
