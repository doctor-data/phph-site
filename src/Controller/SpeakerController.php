<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpeakerController extends Controller
{

    /**
     * @Route("/speaker/{name}", name="speaker")
     * @Method("GET")
     * @return Response
     */
    public function speaker()
    {
        $videos = null;
        try {
            $repo = $this->getDoctrine()->getRepository('App:Talk');
            $qb   = $repo->createQueryBuilder('a');
            $qb->where($qb->expr()->not($qb->expr()->eq('a.youtubeId', '?1')));
            $qb->setParameter(1, '');

            $videos = $qb->getQuery()
                         ->getResult();
        } catch (\Exception $e) {
            $session = $this->get('session');
            $session->getFlashBag()->add(
                'warning',
                "Sorry, we can't access the video storage right now"
            );
        }

        return $this->render(
            'page/videos.html.twig',
            [
                'talksWithVidoes' => $videos,
            ]
        );
    }
}
