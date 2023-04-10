<?php

namespace App\Entity;

use App\Repository\AbonnementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AbonnementsRepository::class)]
class Abonnements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "Please  fill out the title")]
    private ?\DateTimeInterface $date_ab = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "Please  fill out the title")]
    private ?\DateTimeInterface $date_exp = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Please  fill out the title")]
    private ?string $categorie_ab = null;

    #[ORM\OneToMany(mappedBy: 'Abonnements', targetEntity: Reservations::class)]
    #[Assert\NotBlank(message: "Please  fill out the title")]
    private Collection $reservations;


    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->id; // remplacer nomDeLaPropriete par le nom de la propriété que vous souhaitez afficher
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAb(): ?\DateTimeInterface
    {
        return $this->date_ab;
    }

    public function setDateAb(\DateTimeInterface $date_ab): self
    {
        $this->date_ab = $date_ab;

        return $this;
    }

    public function getDateExp(): ?\DateTimeInterface
    {
        return $this->date_exp;
    }

    public function setDateExp(\DateTimeInterface $date_exp): self
    {
        $this->date_exp = $date_exp;

        return $this;
    }

    public function getCategorieAb(): ?string
    {
        return $this->categorie_ab;
    }

    public function setCategorieAb(string $categorie_ab): self
    {
        $this->categorie_ab = $categorie_ab;

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
            $reservation->setAbonnements($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getAbonnements() === $this) {
                $reservation->setAbonnements(null);
            }
        }

        return $this;
    }
}
