<?php

namespace App\DataFixtures;


use App\Entity\Organiser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function __construct(ObjectManager $manager)
    {
        // ensure that UUID is available
        $manager->getConnection()->exec('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
    }

    public function load(ObjectManager $manager)
    {
        $this->createOrganiser($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    protected function createOrganiser(ObjectManager $manager): void
    {
        // Create default organiser

        $organiser = new Organiser();
        $organiser->setDisplayName('admin');
        $organiser->setEmail('test@test.com');
        $organiser->setPassword('admin');
        $organiser->setRole('admin');

        $manager->persist($organiser);
        $manager->flush();
    }
}