<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventbriteData
 *
 * @ORM\Table(name="eventbrite_data", uniqueConstraints={@ORM\UniqueConstraint(name="uniq_9a8a6d6c591e2316", columns={"meetup_id"})})
 * @ORM\Entity
 */
class EventbriteData
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="eventbrite_data_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=1024, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="eventbriteid", type="string", length=1024, nullable=false)
     */
    private $eventbriteid;

    /**
     * @var \Meetup
     *
     * @ORM\ManyToOne(targetEntity="Meetup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="meetup_id", referencedColumnName="id")
     * })
     */
    private $meetup;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getEventbriteid(): ?string
    {
        return $this->eventbriteid;
    }

    public function setEventbriteid(string $eventbriteid): self
    {
        $this->eventbriteid = $eventbriteid;

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


}
