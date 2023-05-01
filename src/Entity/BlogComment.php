<?php

namespace App\Entity;

use App\Repository\BlogCommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BlogCommentRepository::class)]
class BlogComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Please  fill out the title")]
    private ?string $content = null;

  

    #[ORM\ManyToOne(inversedBy: 'blogComments')]
    private ?BlogArticle $BlogArticle = null;

    #[ORM\ManyToOne(inversedBy: 'blogComments')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creatAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatAt = null;

    #[ORM\Column]
    private $likes = 0;
    #[ORM\Column]
    private $dislikes = 0;



    public function getId(): ?int
    {
        return $this->id;
    }
    public function __construct() {
        $this->creatAt = new \DateTime();
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

 

  

    public function getBlogArticle(): ?BlogArticle
    {
        return $this->BlogArticle;
    }

    public function setBlogArticle(?BlogArticle $BlogArticle): self
    {
        $this->BlogArticle = $BlogArticle;

        return $this;
    }

    public function getUtilisateur(): ?utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeInterface
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeInterface $creatAt): self
    {
        $this->creatAt = $creatAt;

        return $this;
    }

    public function getUpdatAt(): ?\DateTimeInterface
    {
        return $this->updatAt;
    }

    public function setUpdatAt(?\DateTimeInterface $updatAt): self
    {
        $this->updatAt = $updatAt;

        return $this;}
        public function getLikes(): ?int
        {
            return (int) $this->likes;
        }
        
        public function setLikes(int $likes): self
        {
            $this->likes = $likes;
        
            return $this;
        }
        
        public function getDislikes(): ?int
        {
            return (int) $this->dislikes;
        }
        
        public function setDislikes(int $dislikes): self
        {
            $this->dislikes = $dislikes;
        
            return $this;
        }
        public function incrementDislikes(): self
    {
        $this->dislikes++;
        
        return $this;
    }
    public function incrementLikes(): self
    {
        $this->likes++;
        return $this;
    }

}
