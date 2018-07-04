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
     * @ORM\SequenceGenerator(sequenceName="member_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=1024, nullable=false, options={"default" : ""})
     */
    private $contact = '';

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=1024, nullable=false, options={"default" : ""})
     */
    private $displayName = '';

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
