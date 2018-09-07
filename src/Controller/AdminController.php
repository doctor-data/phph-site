<?php

namespace App\Controller;

use App\Entity\Organiser;
use App\Form\AppOrganiserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(): array
    {
        return [
            'title' => 'Admin',
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
            'organisers' => $organisers ?? null,
        ];
    }

    /**
     * @Route("/admin/organiser/add", name="organiser_add")
     * @Template("admin/organiser_add.html.twig")
     * @Method("GET")
     */
    public function organiserAdd(): array
    {
        $form = $this->createForm(AppOrganiserType::class);
        $form->add('submit', SubmitType::class);
        $form = $form->createView();

        return [
            'title' => 'Users',
            'form'  => $form,
        ];
    }

    /**
     * @Route("/admin/organiser/add", name="organiser_post")
     * @Template("admin/organiser_add.html.twig")
     * @Method("POST")
     * @param Request $request
     *
     * @return array
     */
    public function organiserSubmit(Request $request): array
    {
        $data = $request->request->get('app_organiser');

        $organiser = new Organiser();
        $organiser->setDisplayName($data['displayName']);
        $organiser->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
        $organiser->setEmail($data['email']);
        $organiser->setRole(serialize($data['role']));

        $orm    = $this->getDoctrine()->getManager();
        $result = 'Your organiser has been added';
        $orm->persist($organiser);
        $orm->flush();

        return [
            'result' => $result,
        ];
    }

    private function generateStorageFault(): void
    {
        $session = $this->get('session');
        $flash   = $session->getFlashBag();
        $flash->add('error', 'Sorry we are having problems connection to the storage right now');
    }
}
