<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MeetupAttendees
 *
 * @ORM\Table(name="meetup_attendees", uniqueConstraints={@ORM\UniqueConstraint(name="meetup_user", columns={"meetup_id", "user_id"})}, indexes={@ORM\Index(name="idx_fb2e8eeca76ed395", columns={"user_id"}), @ORM\Index(name="idx_fb2e8eec591e2316", columns={"meetup_id"})})
 * @ORM\Entity
 */
class MeetupAttendees
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="meetup_attendees_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="check_in_time", type="datetime", nullable=true)
     */
    private $checkInTime;

    /**
     * @var \Meetup
     *
     * @ORM\ManyToOne(targetEntity="Meetup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="meetup_id", referencedColumnName="id")
     * })
     */
    private $meetup;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCheckInTime(): ?\DateTimeInterface
    {
        return $this->checkInTime;
    }

    public function setCheckInTime(?\DateTimeInterface $checkInTime): self
    {
        $this->checkInTime = $checkInTime;

        return $this;
    }

    public function getMeetup(): ?Meetup
    {
        return $this->meetup;
    }

    public function setMeetup(?Meetup $meetup): self
    {
        $this->meetup = $meetup;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
