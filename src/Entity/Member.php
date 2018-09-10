<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="members", uniqueConstraints={@ORM\UniqueConstraint(name="contact", columns={"contact"})})
 * @ORM\Entity
 */
class Member
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\SequenceGenerator(sequenceName="member_id_seq")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", nullable=false, options={"default" : ""})
     */
    private $contact = '';

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", nullable=false, options={"default" : ""})
     */
    private $displayName = '';


    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private $event;

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
     *
     * @return Member
     */
    public function setEvent(Event $event): Member
    {
        $this->event = $event;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

}
