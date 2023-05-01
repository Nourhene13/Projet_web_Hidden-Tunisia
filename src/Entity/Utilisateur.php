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

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: BlogArticle::class)]
    private Collection $blogArticles;

    #[ORM\OneToMany(mappedBy: 'Utilisateur', targetEntity: BlogComment::class)]
    private Collection $blogComments;

    public function __construct()
    {
        $this->blogArticles = new ArrayCollection();
        $this->blogComments = new ArrayCollection();
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


