<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="winners", uniqueConstraints={@ORM\UniqueConstraint(name="winner_id", columns={"id"})})
 * @ORM\Entity
 */
class Winners
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\SequenceGenerator(sequenceName="winner_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var Member
     *
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     * })
     */
    private $member_id = '';

    /**
     * @var Prize
     *
     * @ORM\ManyToOne(targetEntity="Prize")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prize_id", referencedColumnName="id")
     * })
     */
    private $prize_id = '';

}
