<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="organisers", uniqueConstraints={@ORM\UniqueConstraint(name="email_index", columns={"email"})})
 * @ORM\Entity
 */
class Organiser implements UserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\SequenceGenerator(sequenceName="organiser_id_seq")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", nullable=false)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", nullable=false)
     */
    private $displayName;

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Organiser
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Organiser
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return Organiser
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return Organiser
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->getId(),
            $this->getEmail(),
            $this->getPassword(),
            // see section on salt below
            // $this->salt,
        ));
    }


    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return (array)\unserialize($this->getRole());
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
