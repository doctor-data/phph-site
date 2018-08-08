<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="prizes", uniqueConstraints={@ORM\UniqueConstraint(name="prize_id", columns={"id"})})
 * @ORM\Entity
 */
class Prize
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\SequenceGenerator(sequenceName="prize_seq_id", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="prize_name", type="string", length=1024, nullable=false, options={"default" : ""})
     */
    private $prize_name = '';


    /**
     * @var string
     *
     * @ORM\Column(name="prize_date", type="datetime", nullable=false)
     */
    private $prize_date = '';


}
