<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomUser = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Nourritures::class)]
    private Collection $nourritures;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Civilisation::class)]
    private Collection $civilisations;

    public function __construct()
    {
        $this->nourritures = new ArrayCollection();
        $this->civilisations = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->id; // remplacer nomDeLaPropriete par le nom de la propriété que vous souhaitez afficher
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }

    public function setNomUser(string $nomUser): self
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
            $nourriture->setUtilisateur($this);
        }

        return $this;
    }

    public function removeNourriture(Nourritures $nourriture): self
    {
        if ($this->nourritures->removeElement($nourriture)) {
            // set the owning side to null (unless already changed)
            if ($nourriture->getUtilisateur() === $this) {
                $nourriture->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Civilisation>
     */
    public function getCivilisations(): Collection
    {
        return $this->civilisations;
    }

    public function addCivilisation(Civilisation $civilisation): self
    {
        if (!$this->civilisations->contains($civilisation)) {
            $this->civilisations->add($civilisation);
            $civilisation->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCivilisation(Civilisation $civilisation): self
    {
        if ($this->civilisations->removeElement($civilisation)) {
            // set the owning side to null (unless already changed)
            if ($civilisation->getUtilisateur() === $this) {
                $civilisation->setUtilisateur(null);
            }
        }

        return $this;
    }
}
