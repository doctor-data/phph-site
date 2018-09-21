<?php

namespace App\DataFixtures;


use App\Entity\Event;
use App\Entity\Location;
use App\Entity\Organiser;
use App\Entity\Speaker;
use App\Entity\Talk;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * AppFixtures constructor.
     *
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        if ($manager->getConnection()->getParams()["driver"] === 'pdo_pgsql') {
            $manager->getConnection()->exec('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        }
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createOrganiser($manager);
        $this->createLocation($manager);
        $this->createEvent($manager);
        $this->createSpeaker($manager);
        $this->createTalk($manager);
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
        $organiser->setPassword(password_hash('admin', PASSWORD_BCRYPT));
        $organiser->setRole(serialize('ROLE_ADMIN'));

        $manager->persist($organiser);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    protected function createLocation(ObjectManager $manager): void
    {
        // Create default location

        $location = new Location();
        $location->setAddress('1 Upper Arundel St, Portsmouth PO1 1NP');
        $location->setName('Oasis the venue');
        $location->setUrl('https://www.oasisthevenue.co.uk/');

        $manager->persist($location);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    protected function createEvent(ObjectManager $manager): void
    {
        // Create default meet
        $location = $manager->getRepository('App:Location')->findOneBy(['name' => 'Oasis the venue']);
        $event    = new Event();
        $event->setLocation($location);
        $event->setDate(new \DateTime('tomorrow'));
        $manager->persist($event);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    protected function createTalk(ObjectManager $manager): void
    {
        // Create default talks
        $event = $manager->getRepository('App:Event')->findOneBy(['date' => new \Datetime('tomorrow')]);
        $speaker = $manager->getRepository('App:Speaker')->findOneBy(['fullName' => 'James Titcumb']);

        $talk = new Talk();
        $talk->setAbstract(
            'This prototype works, but it’s not pretty, and now it’s in production. That legacy application really needs some TLC. Where do we start? When creating long lived applications, it’s imperative to focus on good practices. The solution is to improve the whole development life cycle; from planning, better coding and testing, to automation, peer review and more. In this tutorial, we’ll take a deep dive into each of these areas, looking at how we can make positive, actionable change in our workflow.

This workshop intends to improve your skills in planning, documenting, some aspects of development, testing and delivery of software for both legacy and greenfield projects. The workshop is made up of multiple exercises, allowing dynamic exploration into the various aspects of the software development life cycle. In each practical exercise, we\'ll brainstorm and investigate solutions, ensuring they are future-proofed, well tested and lead to the ultimate goal of confidence in delivering stable software.'
        );
        $talk->setevent($event);
        $talk->setSpeaker($speaker);
        $talk->setTime(new \DateTime('7pm'));
        $talk->setTitle('Best practices for Crafting High Quality PHP Apps');
        $talk->setYoutubeId('');

        $manager->persist($talk);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    protected function createSpeaker(ObjectManager $manager)
    {
        $speaker = new Speaker();
        $speaker->setBiography(
            'James is a consultant, trainer and developer at Roave. He is a prolific contributor to various open source projects and is a Zend Certified Engineer. He also founded the UK based PHP Hampshire user group and PHP South Coast conference.'
        );
        $speaker->setFullName('James Titcumb');
        $speaker->setImagefilename('https://conference.scotlandphp.co.uk/images/speakers/titcumb.png');
        $speaker->setTwitterhandle('@asgrim');

        $manager->persist($speaker);
        $manager->flush();
    }
}