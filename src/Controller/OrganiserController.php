<?php

namespace App\Controller;

use App\Entity\Organiser;
use App\Form\AppOrganiserType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @Method("GET")
 * @Template()
 * @package App\Controller
 */
class OrganiserController extends Controller
{
    /**
     * @Route("/admin/organisers/", name="organisers")
     * @Template("admin/organiser_index.html.twig")
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
            'title' => 'Organisers',
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
            'form' => $form,
        ];
    }

    /**
     * @Route("/admin/organiser/add", name="organiser_post")
     * @Method("POST")
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function organiserSubmit(Request $request): RedirectResponse
    {
        $data = $request->request->get('app_organiser');

        $organiser = new Organiser();
        $organiser->setDisplayName($data['displayName']);
        $organiser->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
        $organiser->setEmail($data['email']);
        $organiser->setRole(serialize($data['role']));

        try {
            $orm = $this->getDoctrine()->getManager();
            $orm->persist($organiser);
            $orm->flush();
        } catch (UniqueConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->add('error', 'Sorry, this user already exists');
            return $this->redirectToRoute('organisers');
        }

        $this->get('session')->getFlashBag()->add('success', 'Organiser has been added');
        return $this->redirectToRoute('organisers');
    }

    /**
     * @Route("/admin/organiser/{organiser}/delete", name="organiser_delete")
     * @Method("GET")
     *
     * @param Organiser $organiser
     *
     * @return RedirectResponse
     */
    public function organiserDelete(Organiser $organiser): RedirectResponse
    {

        if ($this->getUser()->getId() === $organiser->getId()) {
            $this->get('session')->getFlashBag()->add('error', 'Sorry you can\'t delete yourself');

            return $this->redirectToRoute('organisers');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($organiser);
        $em->flush();
        $this->get('session')->getFlashBag()->add('success', 'Organiser has been deleted');

        return $this->redirectToRoute('organisers');

    }

    /**
     * @Route("/admin/organiser/{organiser}/edit", name="organiser_edit")
     * @Template("admin/organiser_add.html.twig")
     * @Method("GET")
     *
     * @param Organiser $organiser
     *
     * @return array
     */
    public function organiserEdit(Organiser $organiser): array
    {
        $form = $this->createForm(AppOrganiserType::class, $organiser);
        $form->add('submit', SubmitType::class);
        $form = $form->createView();

        return [
            'title' => 'Editing user '.$organiser->getEmail(),
            'form' => $form
        ];
    }

    /**
     * @Route("/admin/organiser/{organiser}/edit", name="organiser_edit_post")
     * @Method("POST")
     *
     * @param Organiser $organiser
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function organiserEditPost(Organiser $organiser, Request $request): RedirectResponse
    {
        $data = $request->request->get('app_organiser');
        $organiser->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
        try {
            $orm = $this->getDoctrine()->getManager();
            $orm->merge($organiser);
            $orm->flush();
        } catch (UniqueConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->add('error', 'Sorry, this user already exists');
            return $this->redirectToRoute('organisers');
        }

        $this->get('session')->getFlashBag()->add('success', 'Organiser has been updated');
        return $this->redirectToRoute('organisers');

    }

    private function generateStorageFault(): void
    {
        $session = $this->get('session');
        $flash = $session->getFlashBag();
        $flash->add('error', 'Sorry we are having problems connection to the storage right now');
    }
}
