<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
    /**
     * @Route("/registration", name="registration")
     */
    public function index()
    {
        return $this->render(
            'registration/index.html.twig',
            [
                'controller_name' => 'RegistrationController',
                'form'            =>
                    $this->createForm(RegistrationType::class)
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
                         ->createView(),
            ]
        );
    }
}
