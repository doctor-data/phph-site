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
        // ensure that UUID is available
        $manager->getConnection()->exec('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
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
        $organiser->setPassword('admin');
        $organiser->setRole('admin');

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
        $event->setFromDate(new \DateTime('tomorrow'));
        $event->setToDate(new \DateTime('tomorrow'));
        $event->setTopic('Event');
        $manager->persist($event);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    protected function createTalk(ObjectManager $manager): void
    {
        // Create default talks
        $event   = $manager->getRepository('App:Event')->findOneBy(['topic' => 'Event']);
        $speaker = $manager->getRepository('App:Speaker')->findOneBy(['fullName' => 'Jez Emery']);

        $talk = new Talk();
        $talk->setAbstract('lorem');
        $talk->setevent($event);
        $talk->setSpeaker($speaker);
        $talk->setTime(new \DateTime('7pm'));
        $talk->setTitle('Talk title');
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
        $speaker->setBiography('This person talk good');
        $speaker->setFullName('Jez Emery');
        $speaker->setImagefilename('');
        $speaker->setTwitterhandle('@JezEmery');

        $manager->persist($speaker);
        $manager->flush();
    }
}