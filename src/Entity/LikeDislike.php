<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikeDislike
 *
 * @ORM\Table(name="like_dislike")
 * @ORM\Entity
 */
class LikeDislike
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer", nullable=false)
     */
    private $likes;

    /**
     * @var int
     *
     * @ORM\Column(name="dislike", type="integer", nullable=false)
     */
    private $dislike;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="id_status", type="integer", nullable=false)
     */
    private $idStatus;


}
