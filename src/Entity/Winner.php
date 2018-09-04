<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="winners", uniqueConstraints={@ORM\UniqueConstraint(name="winner_id", columns={"id"})})
 * @ORM\Entity
 */
class Winner
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


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Winner
     */
    public function setId(string $id): Winner
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Member
     */
    public function getMemberId(): Member
    {
        return $this->member_id;
    }

    /**
     * @param Member $member_id
     *
     * @return Winner
     */
    public function setMemberId(Member $member_id): Winner
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * @return Prize
     */
    public function getPrizeId(): Prize
    {
        return $this->prize_id;
    }

    /**
     * @param Prize $prize_id
     *
     * @return Winner
     */
    public function setPrizeId(Prize $prize_id): Winner
    {
        $this->prize_id = $prize_id;

        return $this;
    }

}
