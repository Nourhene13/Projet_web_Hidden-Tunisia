<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="fk_utilisateur_avis", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_avis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAvis;

    /**
     * @var string
     *
     * @ORM\Column(name="text_avis", type="string", length=7000, nullable=false)
     */
    private $textAvis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_avis", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateAvis = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="rate_avis", type="integer", nullable=false)
     */
    private $rateAvis;

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
