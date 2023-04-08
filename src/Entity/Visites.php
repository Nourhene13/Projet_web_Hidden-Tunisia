<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visites
 *
 * @ORM\Table(name="visites", indexes={@ORM\Index(name="fk_circuit_visite", columns={"id_circuit"}), @ORM\Index(name="fk_civilisation", columns={"id_civilisation"})})
 * @ORM\Entity
 */
class Visites
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_visite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVisite;

    /**
     * @var \Civilisation
     *
     * @ORM\ManyToOne(targetEntity="Civilisation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_civilisation", referencedColumnName="id_civilisation")
     * })
     */
    private $idCivilisation;

    /**
     * @var \Circuits
     *
     * @ORM\ManyToOne(targetEntity="Circuits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_circuit", referencedColumnName="id_circuit")
     * })
     */
    private $idCircuit;


}
