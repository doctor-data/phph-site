<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Member;
use App\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegistrationController
 * @package App\Controller
 */
class RegistrationController extends Controller
{
    /**
     * @Route("/registration/{id}", name="registration")
     * @Method("GET")
     */
    public function index($id): Response
    {
        $formView = $this->createForm(RegistrationType::class)
                         ->add('submit', SubmitType::class)
                         ->add(
                             'consent',
                             CheckboxType::class,
                             [
                                 'label'    => "By checking this box you consent to PHP Hampshire storing and it's organisers having access to the information you provide.",
                                 'required' => true,
                                 'attr'     => ['class' => 'row'],
                             ]
                         )
                         ->add(
                             'talk_id',
                             HiddenType::class,
                             [
                                 'attr' => [
                                     'value' => $id,
                                 ],
                             ]
                         )
                         ->createView();

        return $this->render('registration/index.html.twig', ['form' => $formView]);
    }

    /**
     * @Route("/registration/{id}", name="registration_action")
     * @Method("POST")
     * @param Request $request
     *
     * @return Response
     */
    public function register(Request $request)
    {
        $session  = $this->get('session');
        $response = $request->request->get('registration');
        $event    = $this->getDoctrine()->getRepository('App:Talk')->find($response['talk_id'])->getevent();

        if ($response['consent'] !== '1') {
            $session->getFlashBag()->set(
                'error',
                'Sorry you did not seem to provide consent, please try again!'
            );

            return $this->render('registration/index.html.twig', []);
        }

        if ( ! $this->registerMember($response['name'], $response['email'], $event)) {
            return $this->render('registration/index.html.twig', []);
        }

        $session->getFlashBag()->set('info', 'Thanks for your registration, we look forward to seeing you!');

        return $this->render('registration/index.html.twig', []);
    }

    /**
     * @param $name
     * @param $email
     *
     * @param Event $event
     *
     * @return bool
     */
    private function registerMember($name, $email, Event $event): bool
    {
        $member = new Member();
        $member->setDisplayName($name);
        $member->setEmail($email);
        $member->setEvent($event);

        $mgr = $this->getDoctrine()->getManager();
        try {
            $mgr->persist($member);
            $mgr->flush();
        } catch (\Exception $e) {
            if ($e->getCode() === 0) {
                $session = $this->get('session');
                $session->getFlashBag()->set('info', 'Looks like you have already registered, thanks!');
            }

            return false;
        }

        return true;
    }
}
