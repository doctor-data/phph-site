<?php

namespace App\Controller;

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
     * @Template("admin/index.html.twig")
     * @Method("GET")
     */
    public function memberIndex()
    {
        $members = $this->getDoctrine()->getRepository('App:Member');

        return [
            'title' => 'Members',
            'members' => $members->findAll(),
        ];
    }

    /**
     * @Route("/admin/meets/", name="meet_management")
     * @Method("GET")
     */
    public function meetIndex()
    {
        return [];
    }
}
