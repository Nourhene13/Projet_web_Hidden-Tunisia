<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles", indexes={@ORM\Index(name="fk_permission", columns={"id_permission"})})
 * @ORM\Entity
 */
class Roles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_role", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRole;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_role", type="string", length=255, nullable=false)
     */
    private $nomRole;

    /**
     * @var \Permissions
     *
     * @ORM\ManyToOne(targetEntity="Permissions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_permission", referencedColumnName="id_permission")
     * })
     */
    private $idPermission;


}
