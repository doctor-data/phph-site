<?php
declare(strict_types=1);

namespace App\Entity;

use App\Entity\UserThirdPartyAuthentication\GitHub;
use App\Entity\UserThirdPartyAuthentication\Twitter;
use App\Entity\UserThirdPartyAuthentication\UserThirdPartyAuthentication;
use App\Service\Authentication\ThirdPartyAuthenticationData;
use App\Service\Authorization\Role\AdministratorRole;
use App\Service\Authorization\Role\AttendeeRole;
use App\Service\Authorization\Role\RoleFactory;
use App\Service\Authorization\Role\RoleInterface;
use App\Service\User\PasswordHashInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
/*final */class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="NONE")
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=1024, nullable=false, unique=true)
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="string", length=1024, nullable=false)
     * @var string
     */
    private $password;

    /**
     * @ORM\Column(name="role", type="string", length=1024, nullable=false)
     * @var string
     */
    private $role;

    /**
     * @ORM\Column(name="display_name", type="string", length=1024, nullable=false)
     * @var string
     */
    private $displayName;

    /**
     * @ORM\OneToMany(
     *     targetEntity=MeetupAttendee::class,
     *     mappedBy="user",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     * @var ArrayCollection|MeetupAttendee[]
     */
    private $meetupsAttended;

    /**
     * @ORM\OneToMany(
     *     targetEntity=UserThirdPartyAuthentication::class,
     *     mappedBy="user",
     *     cascade={"persist"},
     *     orphanRemoval=true
     * )
     * @var ArrayCollection|UserThirdPartyAuthentication[]
     */
    private $thirdPartyLogins;

    private function __construct()
    {
        $this->id = (string)Uuid::uuid4();
        $this->meetupsAttended = new ArrayCollection();
        $this->thirdPartyLogins = new ArrayCollection();
    }

    public static function new(
        string $email,
        string $displayName,
        PasswordHashInterface $algorithm,
        string $password
    ) : self {
        $instance = new self();
        $instance->email = $email;
        $instance->displayName = $displayName;
        $instance->password = $algorithm->hash($password);
        $instance->role = AttendeeRole::NAME;
        return $instance;
    }

    public static function fromThirdPartyAuthentication(ThirdPartyAuthenticationData $thirdPartyAuthentication) : self
    {
        $instance = new self();
        $instance->email = $thirdPartyAuthentication->email();
        $instance->displayName = $thirdPartyAuthentication->displayName();
        $instance->password = '';
        $instance->role = AttendeeRole::NAME;

        $instance->thirdPartyLogins->add(UserThirdPartyAuthentication::new($instance, $thirdPartyAuthentication));

        return $instance;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function displayName() : string
    {
        return $this->displayName;
    }

    public function verifyPassword(PasswordHashInterface $algorithm, string $password) : bool
    {
        if ('' === $this->password) {
            return false;
        }

        return $algorithm->verify($password, $this->password);
    }

    public function getRole() : RoleInterface
    {
        return RoleFactory::getRole($this->role);
    }

    public function eligibleForPrizeDraws() : bool
    {
        return !$this->getRole() instanceof AdministratorRole;
    }

    public function isAttending(Meetup $meetup) : bool
    {
        foreach ($this->meetupsAttended as $meetupAttended) {
            if ($meetupAttended->meetup()->getId() === $meetup->getId()) {
                return true;
            }
        }

        return false;
    }

    public function meetupsAttended() : Collection
    {
        return $this->meetupsAttended;
    }

    /**
     * @return UserThirdPartyAuthentication[]
     */
    public function thirdPartyLogins() : array
    {
        return $this->thirdPartyLogins->toArray();
    }

    public function associateThirdPartyLogin(ThirdPartyAuthenticationData $thirdPartyAuthentication): void
    {
        $existingMatchingLogins = $this->thirdPartyLogins->filter(
            function (UserThirdPartyAuthentication $auth) use ($thirdPartyAuthentication) {
                return $auth::type() === $thirdPartyAuthentication->serviceClass()::type()
                    && $auth->uniqueId() === $thirdPartyAuthentication->uniqueId();
            }
        );
        // Already have this login, don't add it again
        if ($existingMatchingLogins->count()) {
            return;
        }
        $this->thirdPartyLogins->add(UserThirdPartyAuthentication::new($this, $thirdPartyAuthentication));
    }

    /**
     * @param UuidInterface $uuid
     * @throws \DomainException
     */
    public function disassociateThirdPartyLoginByUuid(UuidInterface $uuid): void
    {
        $matching = $this->thirdPartyLogins->filter(function (UserThirdPartyAuthentication $auth) use ($uuid) {
            return $auth->id() === (string)$uuid;
        })->first();
        if (false === $matching) {
            throw new \DomainException(sprintf('User %s does not have a login for %s', $this->email, (string)$uuid));
        }
        $this->thirdPartyLogins->removeElement($matching);
    }

    public function twitterHandle() : ?string
    {
        foreach ($this->thirdPartyLogins as $login) {
            if ($login instanceof Twitter) {
                return $login->twitter();
            }
        }

        return null;
    }

    public function githubUsername() : ?string
    {
        foreach ($this->thirdPartyLogins as $login) {
            if ($login instanceof GitHub) {
                return $login->displayName();
            }
        }

        return null;
    }

    public function promoteToAdministrator(): void
    {
        $this->role = AdministratorRole::NAME;
    }

    public function changePassword(PasswordHashInterface $algorithm, string $password): void
    {
        $this->password = $algorithm->hash($password);
    }

    public function changeProfile(string $displayName, string $email): void
    {
        $this->displayName = $displayName;
        $this->email = $email;
    }
}
