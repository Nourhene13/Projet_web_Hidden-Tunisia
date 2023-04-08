<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modules
 *
 * @ORM\Table(name="modules")
 * @ORM\Entity
 */
class Modules
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_module", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idModule;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_module", type="string", length=255, nullable=false)
     */
    private $nomModule;

    /**
     * @var string
     *
     * @ORM\Column(name="description_module", type="string", length=1000, nullable=false)
     */
    private $descriptionModule;


}
