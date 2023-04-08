<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permissions
 *
 * @ORM\Table(name="permissions", indexes={@ORM\Index(name="fk_module", columns={"id_module"})})
 * @ORM\Entity
 */
class Permissions
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_permission", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPermission;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_permission", type="string", length=255, nullable=false)
     */
    private $nomPermission;

    /**
     * @var \Modules
     *
     * @ORM\ManyToOne(targetEntity="Modules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_module", referencedColumnName="id_module")
     * })
     */
    private $idModule;


}
