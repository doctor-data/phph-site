<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends Controller
{
    public function index(): array
    {
        return [
            'title' => 'Admin',
        ];
    }

    private function generateStorageFault(): void
    {
        $session = $this->get('session');
        $flash   = $session->getFlashBag();
        $flash->add('error', 'Sorry we are having problems connection to the storage right now');
    }
}
