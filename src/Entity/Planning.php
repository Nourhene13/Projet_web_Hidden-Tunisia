<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Planning
 *
 * @ORM\Table(name="planning", indexes={@ORM\Index(name="fk_evenement_plan", columns={"id_evenement"}), @ORM\Index(name="fk_circuit_plan", columns={"id_circuit"})})
 * @ORM\Entity
 */
class Planning
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_planning", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPlanning;

    /**
     * @var string
     *
     * @ORM\Column(name="resto", type="string", length=50, nullable=false)
     */
    private $resto;

    /**
     * @var string
     *
     * @ORM\Column(name="hotel", type="string", length=50, nullable=false)
     */
    private $hotel;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacement", type="string", length=100, nullable=false)
     */
    private $emplacement;

    /**
     * @var \Circuits
     *
     * @ORM\ManyToOne(targetEntity="Circuits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_circuit", referencedColumnName="id_circuit")
     * })
     */
    private $idCircuit;

    /**
     * @var \Evenements
     *
     * @ORM\ManyToOne(targetEntity="Evenements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evenement", referencedColumnName="id_evenement")
     * })
     */
    private $idEvenement;


}
