<?php

namespace App\Entity;

use App\Repository\InvitesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitesRepository::class)]
class Invites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_invite = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_invite = null;

    #[ORM\Column(length: 255)]
    private ?string $type_invite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomInvite(): ?string
    {
        return $this->nom_invite;
    }

    public function setNomInvite(string $nom_invite): self
    {
        $this->nom_invite = $nom_invite;

        return $this;
    }

    public function getPrenomInvite(): ?string
    {
        return $this->prenom_invite;
    }

    public function setPrenomInvite(string $prenom_invite): self
    {
        $this->prenom_invite = $prenom_invite;

        return $this;
    }

    public function getTypeInvite(): ?string
    {
        return $this->type_invite;
    }

    public function setTypeInvite(string $type_invite): self
    {
        $this->type_invite = $type_invite;

        return $this;
    }
}
