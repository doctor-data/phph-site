<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Speaker
 *
 * @ORM\Table(name="speaker")
 * @ORM\Entity
 */
class Speaker
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="speaker_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=1024, nullable=false)
     */
    private $fullName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="twitterhandle", type="string", length=1024, nullable=true)
     */
    private $twitterhandle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     */
    private $biography;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagefilename", type="string", length=1024, nullable=true)
     */
    private $imagefilename;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getTwitterhandle(): ?string
    {
        return $this->twitterhandle;
    }

    public function setTwitterhandle(?string $twitterhandle): self
    {
        $this->twitterhandle = $twitterhandle;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getImagefilename(): ?string
    {
        return $this->imagefilename;
    }

    public function setImagefilename(?string $imagefilename): self
    {
        $this->imagefilename = $imagefilename;

        return $this;
    }


}
