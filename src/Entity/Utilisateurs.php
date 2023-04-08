<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table(name="utilisateurs", indexes={@ORM\Index(name="fk_role", columns={"id_role"})})
 * @ORM\Entity
 */
class Utilisateurs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_utilisateur", type="string", length=50, nullable=false)
     */
    private $nomUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_utilisateur", type="string", length=50, nullable=false)
     */
    private $prenomUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_utilisateur", type="string", length=50, nullable=false)
     */
    private $mailUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_telephone", type="string", length=8, nullable=false)
     */
    private $numeroTelephone;

    /**
     * @var int
     *
     * @ORM\Column(name="mote de passe", type="integer", nullable=false)
     */
    private $moteDePasse;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=50, nullable=false)
     */
    private $pseudo;

    /**
     * @var \Roles
     *
     * @ORM\ManyToOne(targetEntity="Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_role", referencedColumnName="id_role")
     * })
     */
    private $idRole;


}
