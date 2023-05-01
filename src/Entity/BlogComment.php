<?php

namespace App\Entity;

use App\Repository\BlogCommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogCommentRepository::class)]
class BlogComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creatAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatAt = null;

    #[ORM\Column]
    private ?int $likes = 0;

    #[ORM\Column]
    private ?int $dislikes = 0;

    #[ORM\ManyToOne(inversedBy: 'blogComments')]
    private ?User $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'blogComments')]
    private ?BlogArticle $BlogArticle = null;

    public function __construct()
    {
        $this->creatAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeImmutable $creatAt): self
    {
        $this->creatAt = $creatAt;

        return $this;
    }

    public function getUpdatAt(): ?\DateTimeImmutable
    {
        return $this->updatAt;
    }

    public function setUpdatAt(?\DateTimeImmutable $updatAt): self
    {
        $this->updatAt = $updatAt;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getDislikes(): ?int
    {
        return $this->dislikes;
    }

    public function setDislikes(int $dislikes): self
    {
        $this->dislikes = $dislikes;

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

    public function getBlogArticle(): ?BlogArticle
    {
        return $this->BlogArticle;
    }

    public function setBlogArticle(?BlogArticle $BlogArticle): self
    {
        $this->BlogArticle = $BlogArticle;

        return $this;
    }
}
