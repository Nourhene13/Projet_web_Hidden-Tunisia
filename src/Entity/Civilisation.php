<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Civilisation
 *
 * @ORM\Table(name="civilisation", indexes={@ORM\Index(name="fk_utilisateur_civi", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Civilisation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_civilisation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCivilisation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_civilisation", type="string", length=50, nullable=false)
     */
    private $nomCivilisation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_monument", type="string", length=50, nullable=false)
     */
    private $nomMonument;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_dbuit_civilisation", type="date", nullable=false)
     */
    private $dateDbuitCivilisation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_civilisation", type="date", nullable=false)
     */
    private $dateFinCivilisation;

    /**
     * @var string
     *
     * @ORM\Column(name="description_civilisation", type="string", length=6000, nullable=false)
     */
    private $descriptionCivilisation;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=344, nullable=false)
     */
    private $image;

    /**
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id_utilisateur")
     * })
     */
    private $idUtilisateur;


}
