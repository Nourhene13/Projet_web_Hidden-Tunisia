<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    public string $confirm_password;
    public string $nouvel_password;

    #[ORM\Column(length: 50)]
    private ?string $nomUser = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomUser = null;

    #[ORM\Column(length: 50)]
    private ?string $numTel = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 5000)]
    private ?string $image = "zserdrfyguyhiuojiohugyfugvjbhkjniiyf";

    #[ORM\Column]
    private ?bool $is_blocked = false;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Evenements::class)]
    private Collection $evenements;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Circuits::class)]
    private Collection $circuits;

    #[ORM\OneToMany(mappedBy: 'idUtilisateur', targetEntity: Civilisation::class)]
    private Collection $civilisations;

    #[ORM\OneToMany(mappedBy: 'idUtilisateur', targetEntity: Nourritures::class)]
    private Collection $nourritures;

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: Reservations::class)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: BlogArticle::class)]
    private Collection $blogArticles;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: BlogComment::class)]
    private Collection $blogComments;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->circuits = new ArrayCollection();
        $this->civilisations = new ArrayCollection();
        $this->nourritures = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->blogArticles = new ArrayCollection();
        $this->blogComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenomUser(): ?string
    {
        return $this->prenomUser;
    }

    public function setPrenomUser(string $prenomUser): self
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

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

    public function isIsBlocked(): ?bool
    {
        return $this->is_blocked;
    }

    public function setIsBlocked(bool $is_blocked): self
    {
        $this->is_blocked = $is_blocked;

        return $this;
    }

    /**
     * @return Collection<int, Evenements>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
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
            $civilisation->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeCivilisation(Civilisation $civilisation): self
    {
        if ($this->civilisations->removeElement($civilisation)) {
            // set the owning side to null (unless already changed)
            if ($civilisation->getIdUtilisateur() === $this) {
                $civilisation->setIdUtilisateur(null);
            }
        }

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
            $nourriture->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeNourriture(Nourritures $nourriture): self
    {
        if ($this->nourritures->removeElement($nourriture)) {
            // set the owning side to null (unless already changed)
            if ($nourriture->getIdUtilisateur() === $this) {
                $nourriture->setIdUtilisateur(null);
            }
        }

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
            $reservation->setUtilisateur($this);
        }

        return $this;
    }

    public function removeReservation(Reservations $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUtilisateur() === $this) {
                $reservation->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BlogArticle>
     */
    public function getBlogArticles(): Collection
    {
        return $this->blogArticles;
    }

    public function addBlogArticle(BlogArticle $blogArticle): self
    {
        if (!$this->blogArticles->contains($blogArticle)) {
            $this->blogArticles->add($blogArticle);
            $blogArticle->setUtilisateur($this);
        }

        return $this;
    }

    public function removeBlogArticle(BlogArticle $blogArticle): self
    {
        if ($this->blogArticles->removeElement($blogArticle)) {
            // set the owning side to null (unless already changed)
            if ($blogArticle->getUtilisateur() === $this) {
                $blogArticle->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BlogComment>
     */
    public function getBlogComments(): Collection
    {
        return $this->blogComments;
    }

    public function addBlogComment(BlogComment $blogComment): self
    {
        if (!$this->blogComments->contains($blogComment)) {
            $this->blogComments->add($blogComment);
            $blogComment->setUtilisateur($this);
        }

        return $this;
    }

    public function removeBlogComment(BlogComment $blogComment): self
    {
        if ($this->blogComments->removeElement($blogComment)) {
            // set the owning side to null (unless already changed)
            if ($blogComment->getUtilisateur() === $this) {
                $blogComment->setUtilisateur(null);
            }
        }

        return $this;
    }
}
