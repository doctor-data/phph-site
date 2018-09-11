<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;

class AdminEventController extends Controller
{

    /**
     * @Route("/admin/events/", name="event_management")
     * @Template("admin/event_index.html.twig")
     * @Method("GET")
     */
    public function eventIndex(): array
    {
        $events = null;
        try {
            /** @var Event $events */
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
     * @Route("/admin/event/add", name="event_add")
     * @Template("admin/event_add.html.twig")
     * @Method("GET")
     * @return array
     */
    public function eventAdd(): array
    {
        $form = $this->createForm(EventType::class);
        $form->add('submit', SubmitType::class);
        $form = $form->createView();

        return [
            'title' => 'Add an event',
            'form'  => $form,
        ];
    }

    /**
     * @Route("/admin/event/{id}/members", name="event_member_management")
     * @Template("admin/member_index.html.twig")
     * @Method("GET")
     */
    public function eventMemberIndex($id): array
    {
        $events = null;
        try {
            $event   = $this->getDoctrine()->getManager()->find('App:Event', $id);
            $members = $this->getDoctrine()->getRepository('App:Member')->findBy(['event' => $event]);
        } catch (\Exception $e) {
            $this->generateStorageFault();
        }

        return [
            'title'   => 'Members attending in '.$event->getFromDate()->format('M-Y'),
            'members' => $members,
        ];
    }


    private function generateStorageFault(): void
    {
        $session = $this->get('session');
        $flash   = $session->getFlashBag();
        $flash->add('error', 'Sorry we are having problems connection to the storage right now');
    }

}