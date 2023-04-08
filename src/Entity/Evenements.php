<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenements
 *
 * @ORM\Table(name="evenements", indexes={@ORM\Index(name="fk_utilisateur_eve", columns={"id_utilisateur"}), @ORM\Index(name="fk_inviter", columns={"id_invite"})})
 * @ORM\Entity
 */
class Evenements
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_evenement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_evenement", type="string", length=255, nullable=false)
     */
    private $titreEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="type_evenement", type="string", length=255, nullable=false)
     */
    private $typeEvenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_evenement", type="date", nullable=false)
     */
    private $dateEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="lieux_evenement", type="string", length=100, nullable=false)
     */
    private $lieuxEvenement;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_evenement", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="description_evenement", type="string", length=1000, nullable=false)
     */
    private $descriptionEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=300, nullable=false)
     */
    private $image;

    /**
     * @var \Invites
     *
     * @ORM\ManyToOne(targetEntity="Invites")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_invite", referencedColumnName="id_invite")
     * })
     */
    private $idInvite;

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
