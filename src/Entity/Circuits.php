<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circuits
 *
 * @ORM\Table(name="circuits", indexes={@ORM\Index(name="fk_utilisateur_circuit", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Circuits
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_circuit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCircuit;

    /**
     * @var string
     *
     * @ORM\Column(name="point_depat_circuit", type="string", length=50, nullable=false)
     */
    private $pointDepatCircuit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_circuit", type="date", nullable=false)
     */
    private $dateDebutCircuit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_circuit", type="date", nullable=false)
     */
    private $dateFinCircuit;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_place_dispo", type="integer", nullable=false)
     */
    private $nbrPlaceDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="description_circuit", type="string", length=8000, nullable=false)
     */
    private $descriptionCircuit;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_jour_circuit", type="integer", nullable=false)
     */
    private $nbrJourCircuit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_circuit", type="string", length=20, nullable=false)
     */
    private $nomCircuit;

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
