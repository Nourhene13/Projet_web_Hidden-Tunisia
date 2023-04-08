<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnements
 *
 * @ORM\Table(name="abonnements", indexes={@ORM\Index(name="fk_utilisateur_ab", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Abonnements
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ab", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ab", type="date", nullable=false)
     */
    private $dateAb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_exp", type="date", nullable=false)
     */
    private $dateExp;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_ab", type="string", length=30, nullable=false)
     */
    private $categorieAb;

    /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=false)
     */
    private $idUtilisateur;


}
