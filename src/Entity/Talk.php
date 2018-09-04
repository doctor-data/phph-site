<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Talk
 *
 * @ORM\Table(name="talks", indexes={@ORM\Index(name="speaker_index", columns={"speaker_id"}), @ORM\Index(name="event_index", columns={"event_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\TalkRepository")
 */
class Talk
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\SequenceGenerator(sequenceName="talk_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=1024, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="abstract", type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var string|null
     *
     * @ORM\Column(name="youtube_id", type="string", length=512, nullable=true)
     */
    private $youtubeId;

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
     * @var Speaker
     *
     * @ORM\ManyToOne(targetEntity="Speaker")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="speaker_id", referencedColumnName="id")
     * })
     */
    private $speaker;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getYoutubeId(): ?string
    {
        return $this->youtubeId;
    }

    public function setYoutubeId(?string $youtubeId): self
    {
        $this->youtubeId = $youtubeId;

        return $this;
    }

    public function getevent(): ?event
    {
        return $this->event;
    }

    public function setevent(?event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getSpeaker(): ?Speaker
    {
        return $this->speaker;
    }

    public function setSpeaker(?Speaker $speaker): self
    {
        $this->speaker = $speaker;

        return $this;
    }

}
