<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
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
     * @var string
     *
     * @ORM\Column(name="description_role", type="string", length=1000, nullable=false)
     */
    private $descriptionRole;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Permissions", inversedBy="idRole")
     * @ORM\JoinTable(name="role_pemission",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_role", referencedColumnName="id_role")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_permission", referencedColumnName="id_permission")
     *   }
     * )
     */
    private $idPermission = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPermission = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
