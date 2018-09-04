<?php

namespace App\Controller;

use App\Entity\Organiser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @Method("GET")
 * @Template()
 * @package App\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/admin/", name="admin")
     * @Method("GET")
     */
    public function index()
    {
        return [];
    }

    /**
     * @Route("/admin/member/", name="member")
     * @Method("GET")
     */
    public function memberIndex()
    {
        try {
            $members = $this->getDoctrine()->getRepository('App:Member')->findAll();
        } catch (\Exception $e) {
            $this->generateStorageFault();
        }

        return [
            'title'   => 'Members',
            'members' => isset($members) ? $members : null,
        ];
    }

    /**
     * @Route("/admin/events/", name="event_management")
     * @Method("GET")
     */
    public function eventIndex(): array
    {
        $events = null;
        try {
            $events = $this->getDoctrine()->getRepository('App:Event')->findAll();
        } catch (\Exception $e) {
            $this->generateStorageFault();
        }

        return [
            'title'  => 'Events',
            'events' => $events,
        ];
    }

    /**
     * @Route("/admin/organisers/", name="user_management")
     * @Method("GET")
     */
    public function organiserIndex(): array
    {
        try {
            $organisers = $this->getDoctrine()->getRepository('App:Organiser')->findAll();
        } catch (\Exception $e) {
            $this->generateStorageFault();
        }


        return [
            'title'      => 'Organisers',
            'organisers' => isset($organisers) ? $organisers : null,
        ];
    }

    /**
     * @Route("/admin/organiser/add", name="organiser_add")
     * @Template(":admin:organiser_index.html.twig")
     * @Method("GET")
     */
    public function organiserAdd(): array
    {
        $organiser = new Organiser();
        $organiser->setDisplayName('jez');
        $organiser->setEmail('jez@hiohzo.com');
        $organiser->setRole('ADMIN');
        $organiser->setPassword(password_hash('password', PASSWORD_BCRYPT));

        $orm = $this->getDoctrine()->getManager();
        $orm->persist($organiser);
        $orm->flush();

        return [
            'title' => 'Users',
            'users' => $organiser,
        ];
    }

    private function generateStorageFault(): void
    {
        $session = $this->get('session');
        $flash   = $session->getFlashBag();
        $flash->add('error', 'Sorry we are having problems connection to the storage right now');
    }
}
