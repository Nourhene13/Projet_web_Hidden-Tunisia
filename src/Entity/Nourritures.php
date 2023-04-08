<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nourritures
 *
 * @ORM\Table(name="nourritures", indexes={@ORM\Index(name="fk_utilisateur_nour", columns={"id_utilisateur"}), @ORM\Index(name="fk_civilisation_nour", columns={"id_civilisation"})})
 * @ORM\Entity
 */
class Nourritures
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_nourriture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNourriture;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_nourriture", type="string", length=50, nullable=false)
     */
    private $nomNourriture;

    /**
     * @var string
     *
     * @ORM\Column(name="origine_nourriture", type="string", length=50, nullable=false)
     */
    private $origineNourriture;

    /**
     * @var string
     *
     * @ORM\Column(name="ingrediant", type="string", length=500, nullable=false)
     */
    private $ingrediant;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_nourriture", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixNourriture;

    /**
     * @var string
     *
     * @ORM\Column(name="description_nourriture", type="string", length=5000, nullable=false)
     */
    private $descriptionNourriture;

    /**
     * @var string
     *
     * @ORM\Column(name="type_nourriture", type="string", length=255, nullable=false)
     */
    private $typeNourriture;

    /**
     * @var \Civilisation
     *
     * @ORM\ManyToOne(targetEntity="Civilisation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_civilisation", referencedColumnName="id_civilisation")
     * })
     */
    private $idCivilisation;

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
