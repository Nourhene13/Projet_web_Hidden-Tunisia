<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status", indexes={@ORM\Index(name="fk_utilisateur_STATUS", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Status
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_status", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_status", type="string", length=255, nullable=false)
     */
    private $titreStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_status", type="string", length=10000, nullable=false)
     */
    private $contenuStatus;

    /**
     * @var int
     *
     * @ORM\Column(name="date_status", type="integer", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateStatus = CURRENT_TIMESTAMP;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_like", type="integer", nullable=false)
     */
    private $nbrLike;

    /**
     * @var string
     *
     * @ORM\Column(name="media_status", type="string", length=255, nullable=false)
     */
    private $mediaStatus;

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
