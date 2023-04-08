<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="fk_utilisateur_rec", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Reclamations
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="type_reclamation", type="string", length=50, nullable=false)
     */
    private $typeReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_reclamation", type="string", length=50, nullable=false)
     */
    private $etatReclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="text_reclamation", type="string", length=7000, nullable=false)
     */
    private $textReclamation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reponse", type="date", nullable=false)
     */
    private $dateReponse;

    /**
     * @var string
     *
     * @ORM\Column(name="text_reponse", type="string", length=7000, nullable=false)
     */
    private $textReponse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reclamation", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateReclamation = 'CURRENT_TIMESTAMP';

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
