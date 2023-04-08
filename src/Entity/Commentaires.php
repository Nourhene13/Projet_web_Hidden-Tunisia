<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires", indexes={@ORM\Index(name="fk_utilisateur_com", columns={"id_utilisateur"}), @ORM\Index(name="fk_status", columns={"id_status"})})
 * @ORM\Entity
 */
class Commentaires
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_commentaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_commentaire", type="string", length=8000, nullable=false)
     */
    private $contenuCommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commentaire", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateCommentaire = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="reponse_commentaire", type="string", length=8000, nullable=false)
     */
    private $reponseCommentaire;

    /**
     * @var \Status
     *
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_status", referencedColumnName="id_status")
     * })
     */
    private $idStatus;

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
