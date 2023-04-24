<?php

namespace App\Entity;

use App\Repository\EvenementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementsRepository::class)]
class Evenements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_evenement = null;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: Reservations::class)]
    private Collection $reservations;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $nbplaces = null;


    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->titre_evenement;
        return $this->nbplaces;
        // remplacer nomDeLaPropriete par le nom de la propriété que vous souhaitez afficher
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    /**
     * @return Collection<int, Reservations>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservations $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setEvenement($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getEvenement() === $this) {
                $reservation->setEvenement(null);
            }
        }

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
