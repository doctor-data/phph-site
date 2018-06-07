<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DoctrineMigrationVersions
 *
 * @ORM\Table(name="doctrine_migration_versions")
 * @ORM\Entity
 */
class DoctrineMigrationVersions
{
    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="doctrine_migration_versions_version_seq", allocationSize=1, initialValue=1)
     */
    private $version;

    public function getVersion(): ?string
    {
        return $this->version;
    }


}
