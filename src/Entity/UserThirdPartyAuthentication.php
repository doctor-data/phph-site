<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserThirdPartyAuthentication
 *
 * @ORM\Table(name="user_third_party_authentication", indexes={@ORM\Index(name="idx_7264d15da76ed395", columns={"user_id"})})
 * @ORM\Entity
 */
class UserThirdPartyAuthentication
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="user_third_party_authentication_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="unique_id", type="string", length=1024, nullable=false)
     */
    private $uniqueId;

    /**
     * @var json
     *
     * @ORM\Column(name="user_data", type="json", nullable=false)
     */
    private $userData;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=1024, nullable=false)
     */
    private $service;

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

    public function getUniqueId(): ?string
    {
        return $this->uniqueId;
    }

    public function setUniqueId(string $uniqueId): self
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    public function getUserData()
    {
        return $this->userData;
    }

    public function setUserData($userData): self
    {
        $this->userData = $userData;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

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
