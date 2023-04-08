<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendaractivity
 *
 * @ORM\Table(name="calendaractivity")
 * @ORM\Entity
 */
class Calendaractivity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_calendaractivity", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCalendaractivity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="clientName", type="string", length=50, nullable=false)
     */
    private $clientname;

    /**
     * @var int
     *
     * @ORM\Column(name="serviceNo", type="integer", nullable=false)
     */
    private $serviceno;


}
