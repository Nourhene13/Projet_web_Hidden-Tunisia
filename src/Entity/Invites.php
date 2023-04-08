<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invites
 *
 * @ORM\Table(name="invites")
 * @ORM\Entity
 */
class Invites
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_invite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInvite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_invite", type="string", length=50, nullable=false)
     */
    private $nomInvite;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_invite", type="string", length=50, nullable=false)
     */
    private $prenomInvite;

    /**
     * @var string
     *
     * @ORM\Column(name="type_invite", type="string", length=255, nullable=false)
     */
    private $typeInvite;


}
